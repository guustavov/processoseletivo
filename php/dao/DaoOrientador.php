<?php
	require_once '../conexao/GerenciadorConexao.php';
	require_once '../classes/Orientador.php';
	
	class DaoOrientador{
		private $conexao;
		
		private function conectar(){
			$gc = new GerenciadorConexao;
			$this->conexao = $gc->pegarConexao();
		}
		
		private function desconectar(){
			$this->conexao = null;
		}
		
		public function inserir($orientador){		
			$this->conectar();
			
			try{
				//montando a query
				$stmt = $this->conexao->prepare("INSERT INTO orientador (codigo, nome, rg, expeditor, cpf, email, senha) VALUES (?, ?, ?, ?, ?, ?, ?)");
				// sequencia de parametros para o lugar dos ?
				$stmt->bindValue(1, $orientador->getCodigo());
				$stmt->bindValue(2, $orientador->getNome());
				$stmt->bindValue(3, $orientador->getRg());
				$stmt->bindValue(4, $orientador->getExpeditor());
				$stmt->bindValue(5, $orientador->getCpf());
				$stmt->bindValue(6, $orientador->getEmail());
				$stmt->bindValue(7, $orientador->getSenha());
				
				
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
			$vetOrientadores = array();
			try{
				$stmt = $this->conexao->query("SELECT * FROM orientador");
				
				foreach($stmt as $row){
					$orientador = new Orientador;
					$orientador->setCodigo($row["codigo"]);
					$orientador->setNome($row["nome"]);
					$orientador->setRg($row["rg"]);
					$orientador->setExpeditor($row["expeditor"]);
					$orientador->setCpf($row["cpf"]);
					$orientador->setEmail($row["email"]);
					$orientador->setSenha($row["senha"]);
					$vetOrientadores[] = $orientador;
				}
				
				$this->desconectar();
				return $vetOrientadores;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
		
		public function consultarFiltro($tipo, $valor){
			$this->conectar();
			$vetOrientadores = array();
			try{
				$stmt = $this->conexao->query("SELECT * FROM orientador WHERE ". $tipo . " like '%" . $valor."%'");
				
				foreach($stmt as $row){
					$orientador = new Orientador;
					$orientador->setCodigo($row["codigo"]);
					$orientador->setNome($row["nome"]);
					$orientador->setRg($row["rg"]);
					$orientador->setExpeditor($row["expeditor"]);
					$orientador->setCpf($row["cpf"]);
					$orientador->setEmail($row["email"]);
					$orientador->setSenha($row["senha"]);
					$vetOrientadores[] = $orientador;
				}
				
				$this->desconectar();
				return $vetOrientadores;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
		
		public function consultarCodigo($codigo){
			$this->conectar();
			$vetOrientadores = array();
			try{
				$stmt = $this->conexao->query("SELECT * FROM orientador WHERE codigo=" . $codigo);
				
				foreach($stmt as $row){
					$orientador = new Orientador;
					$orientador->setCodigo($row["codigo"]);
					$orientador->setNome($row["nome"]);
					$orientador->setRg($row["rg"]);
					$orientador->setExpeditor($row["expeditor"]);
					$orientador->setCpf($row["cpf"]);
					$orientador->setEmail($row["email"]);
					$orientador->setSenha($row["senha"]);
					$vetOrientadores[] = $orientador;
				}
				
				$this->desconectar();
				return $vetOrientadores;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
		
		public function consultarUsuarios($ori){
			$this->conectar();
			
			try{
				$retorno = '';
				$stmt = $this->conexao->query("SELECT * FROM orientador WHERE rg=" . $ori->getRg());
				
				$count = $stmt->rowCount();
				
				if($count != 0){
					// "Gente o rg existe";
					$retorno = 'rg';

				}else{

					$stmt = $this->conexao->query("SELECT * FROM orientador WHERE cpf=" . $ori->getCpf());
					
					$count = $stmt->rowCount();
					
					if($count != 0){
						// "Gente o cpf  existe";
						$retorno = 'cpf';
					}else{
					
						$stmt = $this->conexao->query("SELECT * FROM orientador WHERE email='" . $ori->getEmail()."'");
						
						$count = $stmt->rowCount();

						if($count != 0){
							// "Gente o email  existe";
							$retorno = 'email';
						}
					}
				}
				
				$this->desconectar();
				return $retorno;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
		
		public function consultarUsuariosAlterar($ori){
			$this->conectar();
			
			try{
				$retorno = '';
				$stmt = $this->conexao->query("SELECT * FROM orientador WHERE rg=" . $ori->getRg() . " AND codigo<>" .$ori->getCodigo());
				
				$count = $stmt->rowCount();
				
				if($count != 0){
					// "Gente o rg existe";
					$retorno = 'rg';

				}else{

					$stmt = $this->conexao->query("SELECT * FROM orientador WHERE cpf=" . $ori->getCpf() . " AND codigo<>" .$ori->getCodigo());
					
					$count = $stmt->rowCount();
					
					if($count != 0){
						// "Gente o cpf  existe";
						$retorno = 'cpf';
					}else{
					
						$stmt = $this->conexao->query("SELECT * FROM orientador WHERE email='" . $ori->getEmail() . "' AND codigo<>" .$ori->getCodigo());
						
						$count = $stmt->rowCount();

						if($count != 0){
							// "Gente o email  existe";
							$retorno = 'email';
						}
					}
				}
				
				$this->desconectar();
				return $retorno;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
		
		public function excluir($codigo){
			try{
				$this->conectar();
				$qt = $this->conexao->exec("DELETE FROM orientador where codigo = " . $codigo);
				$this->desconectar();
				return $qt;
			}catch (PDOException $ex){
				echo ("Erro: ". $ex->getMessage());				
			}				
		}
		
		public function alterar($orientador){
			$this->conectar(); 
			
			try{
				//montando a query
				$stmt = $this->conexao->prepare("UPDATE orientador SET nome=?, rg=?, expeditor=?, cpf=?, email=?, senha=? WHERE codigo = " . $orientador->getCodigo());
				// sequencia de parametros para o lugar dos ?
				$stmt->bindValue(1, $orientador->getNome());
				$stmt->bindValue(2, $orientador->getRg());
				$stmt->bindValue(3, $orientador->getExpeditor());
				$stmt->bindValue(4, $orientador->getCpf());
				$stmt->bindValue(5, $orientador->getEmail());
				$stmt->bindValue(6, $orientador->getSenha());
				
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