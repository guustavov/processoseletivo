<?php
	require_once '../conexao/GerenciadorConexao.php';
	require_once '../classes/Prova.php';
	
	class DaoProva{
		private $conexao;
		
		private function conectar(){
			$gc = new GerenciadorConexao;
			$this->conexao = $gc->pegarConexao();
		}
		
		private function desconectar(){
			$this->conexao = null;
		}
		
		public function inserir($prova){		
			$this->conectar();
			
			try{
				//montando a query
				$stmt = $this->conexao->prepare("INSERT INTO prova (codigo, nome, data_criacao, data_realizacao, duracao) VALUES (?, ?, ?, ?, ?)");
				// sequencia de parametros para o lugar dos ?
				$stmt->bindValue(1, $prova->getCodigo());
				$stmt->bindValue(2, $prova->getNome());
				$stmt->bindValue(3, $prova->getData_criacao());			
				$stmt->bindValue(4, $prova->getData_realizacao());		
				$stmt->bindValue(5, $prova->getDuracao());		
				
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
			
			try{
				$stmt = $this->conexao->query("SELECT * FROM prova");
				
				foreach($stmt as $row){
					$Prova = new Prova;
					$Prova->setCodigo($row["codigo"]);
					$Prova->setNome($row["nome"]);
					$Prova->setData_criacao($row["data_criacao"]);
					$Prova->setData_realizacao($row["data_realizacao"]);
					$Prova->setDuracao($row["duracao"]);
					$vetProvas[] = $Prova;
				}
				
				$this->desconectar();
				return $vetProvas;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
		
		public function contarProva(){
			$this->conectar();
			
			try{
				$stmt = $this->conexao->query("SELECT * FROM prova ORDER BY codigo DESC LIMIT 1");
				
				foreach($stmt as $row){
					$valor = $row["codigo"];
				}
				
				$this->desconectar();
				return $valor;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
		
		public function verificarData($codigo_candidato){
			$this->conectar();
			
			try{
				$stmt = $this->conexao->query("select p.data_realizacao from prova p INNER JOIN candidato_has_grupo cg WHERE cg.grupo_codigo = p.codigo AND  cg.candidato_codigo = " . $codigo_candidato);
				
				foreach($stmt as $row){
					$data_realizacao = $row["data_realizacao"];
				}
				
				$this->desconectar();
				return $data_realizacao;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
		
		public function verificarDuracao($codigo_candidato){
			$this->conectar();
			
			try{
				$stmt = $this->conexao->query("select p.duracao from prova p INNER JOIN candidato_has_grupo cg WHERE cg.grupo_codigo = p.codigo AND  cg.candidato_codigo = " . $codigo_candidato);
				
				foreach($stmt as $row){
					$duracao = $row["duracao"];
				}
				
				$this->desconectar();
				return $duracao;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
	
	}
?>