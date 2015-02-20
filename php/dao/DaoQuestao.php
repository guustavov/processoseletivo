<?php
	require_once '../conexao/GerenciadorConexao.php';
	require_once '../classes/Questao.php';
	
	class DaoQuestao{
		private $conexao;
		
		private function conectar(){
			$gc = new GerenciadorConexao;
			$this->conexao = $gc->pegarConexao();
		}
		
		private function desconectar(){
			$this->conexao = null;
		}
		
		public function inserir($questao){		
			$this->conectar();
			
			try{
				//montando a query
				$stmt = $this->conexao->prepare("INSERT INTO questao (codigo, nivel, descricao, gabarito, a, b, c, d, disciplina_codigo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
				// sequencia de parametros para o lugar dos ?
				$stmt->bindValue(1, $questao->getCodigo());
				$stmt->bindValue(2, $questao->getNivel());
				$stmt->bindValue(3, $questao->getDescricao());
				$stmt->bindValue(4, $questao->getGabarito());
				$stmt->bindValue(5, $questao->getA());
				$stmt->bindValue(6, $questao->getB());
				$stmt->bindValue(7, $questao->getC());
				$stmt->bindValue(8, $questao->getD());
				$stmt->bindValue(9, $questao->getDisciplinaCodigo());
				
				
				//executando o query
				$resultado = $stmt->execute();
				$this->desconectar();
				return $resultado;
			}catch (PDOException $ex){
				echo ("Erro: ". $ex->getMessage());				
			}
		}

		public function consultar(){
			$this->conectar();
			$vetQues = array();
			try{
				$stmt = $this->conexao->query("SELECT * FROM questao");
				
				foreach($stmt as $row){
					$questao = new Questao;
					$questao->setCodigo($row["codigo"]);
					$questao->setDisciplinaCodigo($row["disciplina_codigo"]);
					$questao->setNivel($row["nivel"]);
					$questao->setDescricao($row["descricao"]);
					$questao->setGabarito(strtoupper($row["gabarito"]));
					$questao->setA($row["a"]);
					$questao->setB($row["b"]);
					$questao->setC($row["c"]);
					$questao->setD($row["d"]);
					$vetQues[] = $questao;
				}
				
				$this->desconectar();
				return $vetQues;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
		
		public function consultarCodigo($codigo){
			$this->conectar();
			$vetQues = array();
			try{
				$stmt = $this->conexao->query("SELECT * FROM questao WHERE codigo=" . $codigo);
				
				foreach($stmt as $row){
					$questao = new Questao;
					$questao->setCodigo($row["codigo"]);
					$questao->setDisciplinaCodigo($row["disciplina_codigo"]);
					$questao->setNivel($row["nivel"]);
					$questao->setDescricao($row["descricao"]);
					$questao->setGabarito($row["gabarito"]);
					$questao->setA($row["a"]);
					$questao->setB($row["b"]);
					$questao->setC($row["c"]);
					$questao->setD($row["d"]);
					$vetQues[] = $questao;
				}
	
				$this->desconectar();
				return $vetQues;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
		
		public function consultarFiltro($tipo, $valor){
			$this->conectar();
			$vetQues = array();
			try{
				$stmt = $this->conexao->query("SELECT * FROM questao WHERE ". $tipo . " like '%" . $valor."%'");
			
				foreach($stmt as $row){
					$questao = new Questao;
					$questao->setCodigo($row["codigo"]);
					$questao->setDisciplinaCodigo($row["disciplina_codigo"]);
					$questao->setNivel($row["nivel"]);
					$questao->setDescricao($row["descricao"]);
					$questao->setGabarito(strtoupper($row["gabarito"]));
					$questao->setA($row["a"]);
					$questao->setB($row["b"]);
					$questao->setC($row["c"]);
					$questao->setD($row["d"]);
					$vetQues[] = $questao;
				}
				
				$this->desconectar();
				return $vetQues;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
		
		public function consultarNivelDisci($nivel, $disciplina, $qntd){
			$this->conectar();
			$vetQues = array();
			try{
				$stmt = $this->conexao->query("SELECT codigo FROM questao WHERE nivel='". $nivel ."' AND disciplina_codigo=" . $disciplina ." ORDER BY rand() LIMIT " . $qntd);
			
				foreach($stmt as $row){
					$codigoQuestao = $row["codigo"];
					$vetQues[] = $codigoQuestao;
				}
				
				$this->desconectar();
				return $vetQues;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
		
		public function excluir($codigo){
			try{
				$this->conectar();
				$qt = $this->conexao->exec("DELETE FROM questao where codigo = " . $codigo);
				$this->desconectar();
				
			}catch (PDOException $ex){
				echo ("Erro: ". $ex->getMessage());				
			}				
		}
		
		public function alterar($questao){
			$this->conectar(); 
			
			try{
				//montando a query
				$stmt = $this->conexao->prepare("UPDATE questao SET disciplina_codigo=?, nivel=?, descricao=?, gabarito=?, a=?, b=?, c=?, d=? WHERE codigo = " . $questao->getCodigo());
				// sequencia de parametros para o lugar dos ?
				$stmt->bindValue(1, $questao->getDisciplinaCodigo());
				$stmt->bindValue(2, $questao->getNivel());
				$stmt->bindValue(3, $questao->getDescricao());
				$stmt->bindValue(4, $questao->getGabarito());
				$stmt->bindValue(5, $questao->getA());
				$stmt->bindValue(6, $questao->getB());
				$stmt->bindValue(7, $questao->getC());
				$stmt->bindValue(8, $questao->getD());
				
				//executando o query
				$resultado = $stmt->execute();
				$this->desconectar();
				return $resultado;
			}catch (PDOException $ex){
				echo ("Erro: ". $ex->getMessage());				
			}
		}	
	}
?>