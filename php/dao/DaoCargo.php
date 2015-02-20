<?php
	require_once '../conexao/GerenciadorConexao.php';
	require_once '../classes/Cargo.php';
	
	class DaoCargo{
		private $conexao;
		
		private function conectar(){
			$gc = new GerenciadorConexao;
			$this->conexao = $gc->pegarConexao();
		}
		
		private function desconectar(){
			$this->conexao = null;
		}
		
		public function inserir($cargo){		
			$this->conectar();
			
			try{
				//montando a query
				$stmt = $this->conexao->prepare("INSERT INTO cargo (codigo, cargo) VALUES (?, ?)");
				// sequencia de parametros para o lugar dos ?
				$stmt->bindValue(1, $cargo->getCodigo());
				$stmt->bindValue(2, $cargo->getCargo());
				
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
			$vetCargos = array();
			try{
				$stmt = $this->conexao->query("SELECT * FROM cargo");
				
				foreach($stmt as $row){
					$cargo = new Cargo;
					$cargo->setCodigo($row["codigo"]);
					$cargo->setCargo($row["cargo"]);
					$vetCargos[] = $cargo;
				}
				
				$this->desconectar();
				return $vetCargos;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
		
		public function verificarCadastro($cargo){
			$this->conectar();
			try{
				$retorno = '';
				$cargo = $cargo . " " . date("Y"); 
				
				$stmt = $this->conexao->query("SELECT * FROM grupo WHERE nome = '" . $cargo . "'");
				
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
				
		public function consultarCodigo($codigo){
			$this->conectar();
			$vetCargos = array();
			try{
				$stmt = $this->conexao->query("SELECT * FROM cargo WHERE codigo=" . $codigo);
				
				foreach($stmt as $row){
					$cargo = new Cargo;
					$cargo->setCodigo($row["codigo"]);
					$cargo->setCargo($row["cargo"]);
					$vetCargos[] = $cargo;
				}
				
				$this->desconectar();
				return $vetCargos;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
		
		public function consultarAlterar($carg){
			$this->conectar();
			
			try{
				$retorno = '';
				$stmt = $this->conexao->query("SELECT * FROM cargo WHERE cargo='" . $carg->getCargo() ."' AND codigo<>" .$carg->getCodigo());
				
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

		public function alterar($cargo){
			$this->conectar(); 
			
			try{
				//montando a query
				$stmt = $this->conexao->prepare("UPDATE cargo SET cargo=? WHERE codigo = " . $cargo->getCodigo());
				// sequencia de parametros para o lugar dos ?
				$stmt->bindValue(1, $cargo->getCargo());
				
				
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