<?php
	require_once '../conexao/GerenciadorConexao.php';
	require_once '../classes/Administrador.php';
	
	class DaoAdministrador{
		private $conexao;
		
		private function conectar(){
			$gc = new GerenciadorConexao;
			$this->conexao = $gc->pegarConexao();
		}
		
		private function desconectar(){
			$this->conexao = null;
		}
		
			
		public function consultarCodigo($codigo){
			$this->conectar();
			$vetAdministradores = array();
			try{
				$stmt = $this->conexao->query("SELECT * FROM administrador WHERE codigo=" . $codigo);
				
				foreach($stmt as $row){
					$administrador = new Administrador;
					$administrador->setCodigo($row["codigo"]);
					$administrador->setNome($row["nome"]);
					$administrador->setSenha($row["senha"]);
					$vetAdministradores[] = $administrador;
				}
				
				$this->desconectar();
				return $vetAdministradores;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
				

		public function alterar($administrador){
			$this->conectar(); 
			
			try{
				//montando a query
				$stmt = $this->conexao->prepare("UPDATE administrador SET nome=?, senha=? WHERE codigo = " . $administrador->getCodigo());
				// sequencia de parametros para o lugar dos ?
				$stmt->bindValue(1, $administrador->getNome());
				$stmt->bindValue(2, $administrador->getSenha());
				
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