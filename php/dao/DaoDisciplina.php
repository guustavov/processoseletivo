<?php
	require_once '../conexao/GerenciadorConexao.php';
	require_once '../classes/Disciplina.php';
	
	class DaoDisciplina{
		private $conexao;
		
		private function conectar(){
			$gc = new GerenciadorConexao;
			$this->conexao = $gc->pegarConexao();
		}
		
		private function desconectar(){
			$this->conexao = null;
		}
		
		public function inserir($disciplina){		
			$this->conectar();
			
			try{
				//montando a query
				$stmt = $this->conexao->prepare("INSERT INTO disciplina (codigo, disciplina) VALUES (?, ?)");
				// sequencia de parametros para o lugar dos ?
				$stmt->bindValue(1, $disciplina->getCodigo());
				$stmt->bindValue(2, $disciplina->getDisciplina());
				
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
			$vetDisciplinas = array();
			try{
				$stmt = $this->conexao->query("SELECT * FROM disciplina");
				
				foreach($stmt as $row){
					$disciplina = new Disciplina;
					$disciplina->setCodigo($row["codigo"]);
					$disciplina->setDisciplina($row["disciplina"]);
					$vetDisciplinas[] = $disciplina;
				}
				
				$this->desconectar();
				return $vetDisciplinas;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
		
		public function consultarCodigo($codigo){
			$this->conectar();
			$vetDisciplinas = array();
			try{
				$stmt = $this->conexao->query("SELECT * FROM disciplina WHERE codigo=" . $codigo);
				
				foreach($stmt as $row){
					$disciplina = new Disciplina;
					$disciplina->setCodigo($row["codigo"]);
					$disciplina->setDisciplina($row["disciplina"]);
					$vetDisciplinas[] = $disciplina;
				}
				
				$this->desconectar();
				return $vetDisciplinas;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
		
		public function verificarCadastro($codigo){
			$this->conectar();
			try{
				$retorno = '';
						
				$stmt = $this->conexao->query("SELECT * FROM questao WHERE disciplina_codigo = '" . $codigo. "'");
				
				$count = $stmt->rowCount();
				
				if($count == 0){
					// "Gente a disci existe";
					$retorno = true;

				}
				
				$this->desconectar();
				return $retorno;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
		
		public function consultarAlterar($disci){
			$this->conectar();
			
			try{
				$retorno = '';
				$stmt = $this->conexao->query("SELECT * FROM disciplina WHERE disciplina='" . $disci->getDisciplina() ."' AND codigo<>" .$disci->getCodigo());
				
				$count = $stmt->rowCount();
				
				if($count != 0){
					// "Gente a disci existe";
					$retorno = true;

				}
				
				$this->desconectar();
				return $retorno;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
		
		public function contaDisciplina($disciplina, $nivel){
			$this->conectar();
			try{
				$stmt = $this->conexao->query("select COUNT(q.codigo) from disciplina d, questao q WHERE q.disciplina_codigo = d.codigo AND d.disciplina = '" . $disciplina ."' AND q.nivel = '" . $nivel . "' GROUP BY d.disciplina, q.nivel ORDER BY q.codigo");
				$qntd = 0;
				foreach($stmt as $row){
					$qntd =  $row["COUNT(q.codigo)"];
				}
				$this->desconectar();
				return $qntd;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}

		public function alterar($disciplina){
			$this->conectar(); 
			
			try{
				//montando a query
				$stmt = $this->conexao->prepare("UPDATE disciplina SET disciplina=? WHERE codigo = " . $disciplina->getCodigo());
				// sequencia de parametros para o lugar dos ?
				$stmt->bindValue(1, $disciplina->getDisciplina());
				
				
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