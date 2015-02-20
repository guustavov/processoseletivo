<?php
	require_once '../conexao/GerenciadorConexao.php';
	require_once '../classes/Candidato.php';
	require_once '../classes/CandidatoGrupo.php';
	
	class DaoCandidato{
		private $conexao;
		
		private function conectar(){
			$gc = new GerenciadorConexao;
			$this->conexao = $gc->pegarConexao();
		}
		
		private function desconectar(){
			$this->conexao = null;
		}
		
		public function inserir($candidato){		
			$this->conectar();
			
			try{
				//montando a query
				$stmt = $this->conexao->prepare("INSERT INTO candidato (codigo, nome, rg, expeditor, cpf, data_nascimento, email, senha, cargo_codigo, escolaridade, telefone, rua, numero, cep, bairro, cidade, estado, complemento) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
				// sequencia de parametros para o lugar dos ?
				$stmt->bindValue(1, $candidato->getCodigo());
				$stmt->bindValue(2, $candidato->getNome());
				$stmt->bindValue(3, $candidato->getRg());
				$stmt->bindValue(4, $candidato->getExpeditor());
				$stmt->bindValue(5, $candidato->getCpf());
				$stmt->bindValue(6, $candidato->getData_nascimento());
				$stmt->bindValue(7, $candidato->getEmail());
				$stmt->bindValue(8, $candidato->getSenha());
				$stmt->bindValue(9, $candidato->getCargoCodigo());
				$stmt->bindValue(10, $candidato->getEscolaridade());
				$stmt->bindValue(11, $candidato->getTelefone());
				$stmt->bindValue(12, $candidato->getRua());
				$stmt->bindValue(13, $candidato->getNumero());
				$stmt->bindValue(14, $candidato->getCep());
				$stmt->bindValue(15, $candidato->getBairro());
				$stmt->bindValue(16, $candidato->getCidade());
				$stmt->bindValue(17, $candidato->getEstado());
				$stmt->bindValue(18, $candidato->getComplemento());
				
				
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
			$vetCandidatos = array();
			try{
				$stmt = $this->conexao->query("select cand.*, c.cargo from candidato cand, cargo c  WHERE c.codigo=cand.cargo_codigo");
				
				foreach($stmt as $row){
					$data_nascimento = $row["data_nascimento"];
					$dia = substr($data_nascimento, 8, 10);
					$mes = substr($data_nascimento, 5, 2);
					$ano = substr($data_nascimento, 0, 4);	

					$candidato = new Candidato;
					$candidato->setCodigo($row["codigo"]);
					$candidato->setNome($row["nome"]);
					$candidato->setRg($row["rg"]);
					$candidato->setExpeditor($row["expeditor"]);
					$candidato->setCpf($row["cpf"]);
					$candidato->setData_nascimento($dia."/".$mes."/".$ano);
					$candidato->setEmail($row["email"]);
					$candidato->setSenha($row["senha"]);
					$candidato->setCargoCodigo($row["cargo_codigo"]);
					$candidato->setEscolaridade($row["escolaridade"]);
					$candidato->setTelefone($row["telefone"]);
					$candidato->setRua($row["rua"]);
					$candidato->setNumero($row["numero"]);
					$candidato->setCep($row["cep"]);
					$candidato->setBairro($row["bairro"]);
					$candidato->setCidade($row["cidade"]);
					$candidato->setEstado($row["estado"]);
					$candidato->setComplemento($row["complemento"]);
					$candidato->setCargo($row["cargo"]);
					$vetCandidatos[] = $candidato;
				}
				
				$this->desconectar();
				return $vetCandidatos;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
		
		public function excluir($codigo){
			try{
				$this->conectar();
				$qt = $this->conexao->exec("DELETE FROM candidato where codigo = " . $codigo);
				$this->desconectar();
				
			}catch (PDOException $ex){
				echo ("Erro: ". $ex->getMessage());				
			}				
		}
		
		public function consultarFiltro($tipo, $valor){
			$this->conectar();
			$vetCandidatos = array();
			try{
				$stmt = $this->conexao->query("select cand.*, c.cargo from candidato cand, cargo c  WHERE c.codigo=cand.cargo_codigo AND ". $tipo . " like '%" . $valor."%'");
				
				if($tipo == "endereco"){
					$stmt = $this->conexao->query("select cand.*, c.cargo from candidato cand, cargo c  WHERE c.codigo=cand.cargo_codigo AND (rua like '%".$valor."%') OR (numero like '%".$valor."%') OR (bairro like '%".$valor."%') OR (cidade like '%".$valor."%') OR (estado like '%".$valor."%')");
				}
				
				foreach($stmt as $row){
					$data_nascimento = $row["data_nascimento"];
					$dia = substr($data_nascimento, 8, 10);
					$mes = substr($data_nascimento, 5, 2);
					$ano = substr($data_nascimento, 0, 4);

					$candidato = new Candidato;
					$candidato->setCodigo($row["codigo"]);
					$candidato->setNome($row["nome"]);
					$candidato->setRg($row["rg"]);
					$candidato->setExpeditor($row["expeditor"]);
					$candidato->setCpf($row["cpf"]);
					$candidato->setData_nascimento($dia."/".$mes."/".$ano);
					$candidato->setEmail($row["email"]);
					$candidato->setSenha($row["senha"]);
					$candidato->setCargoCodigo($row["cargo_codigo"]);
					$candidato->setEscolaridade($row["escolaridade"]);
					$candidato->setTelefone($row["telefone"]);
					$candidato->setRua($row["rua"]);
					$candidato->setNumero($row["numero"]);
					$candidato->setCep($row["cep"]);
					$candidato->setBairro($row["bairro"]);
					$candidato->setCidade($row["cidade"]);
					$candidato->setEstado($row["estado"]);
					$candidato->setComplemento($row["complemento"]);
					$candidato->setCargo($row["cargo"]);
					$vetCandidatos[] = $candidato;
				}
				
				$this->desconectar();
				return $vetCandidatos;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
		
		public function consultarCargo($valor){
			$this->conectar();
			$vetCandidatos = array();
			try{
				$stmt = $this->conexao->query("select cand.*, c.cargo from candidato cand, cargo c  WHERE c.codigo=cand.cargo_codigo AND c.cargo = '".$valor."'");
								
				foreach($stmt as $row){
					$data_nascimento = $row["data_nascimento"];
					$dia = substr($data_nascimento, 8, 10);
					$mes = substr($data_nascimento, 5, 2);
					$ano = substr($data_nascimento, 0, 4);
					
					$candidato = new Candidato;
					$candidato->setCodigo($row["codigo"]);
					$candidato->setNome($row["nome"]);
					$candidato->setRg($row["rg"]);
					$candidato->setExpeditor($row["expeditor"]);
					$candidato->setCpf($row["cpf"]);
					$candidato->setData_nascimento($dia."/".$mes."/".$ano);
					$candidato->setEmail($row["email"]);
					$candidato->setSenha($row["senha"]);
					$candidato->setCargoCodigo($row["cargo_codigo"]);
					$candidato->setEscolaridade($row["escolaridade"]);
					$candidato->setTelefone($row["telefone"]);
					$candidato->setRua($row["rua"]);
					$candidato->setNumero($row["numero"]);
					$candidato->setCep($row["cep"]);
					$candidato->setBairro($row["bairro"]);
					$candidato->setCidade($row["cidade"]);
					$candidato->setEstado($row["estado"]);
					$candidato->setComplemento($row["complemento"]);
					$candidato->setCargo($row["cargo"]);
					$vetCandidatos[] = $candidato;
				}
				
				$this->desconectar();
				return $vetCandidatos;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
		
		public function consultarCodigo($codigo){
			$this->conectar();
			$vetCandidatos = array();
			try{
				$stmt = $this->conexao->query("select cand.*, c.cargo from candidato cand, cargo c  WHERE c.codigo=cand.cargo_codigo and cand.codigo=" . $codigo);
							
				foreach($stmt as $row){
					$data_nascimento = $row["data_nascimento"];
					$dia = substr($data_nascimento, 8, 10);
					$mes = substr($data_nascimento, 5, 2);
					$ano = substr($data_nascimento, 0, 4);

					$candidato = new Candidato;
					$candidato->setCodigo($row["codigo"]);
					$candidato->setNome($row["nome"]);
					$candidato->setRg($row["rg"]);
					$candidato->setExpeditor($row["expeditor"]);
					$candidato->setCpf($row["cpf"]);
					$candidato->setData_nascimento($dia."/".$mes."/".$ano);
					$candidato->setEmail($row["email"]);
					$candidato->setSenha($row["senha"]);
					$candidato->setCargoCodigo($row["cargo_codigo"]);
					$candidato->setEscolaridade($row["escolaridade"]);
					$candidato->setTelefone($row["telefone"]);
					$candidato->setRua($row["rua"]);
					$candidato->setNumero($row["numero"]);
					$candidato->setCep($row["cep"]);
					$candidato->setBairro($row["bairro"]);
					$candidato->setCidade($row["cidade"]);
					$candidato->setEstado($row["estado"]);
					$candidato->setComplemento($row["complemento"]);
					$candidato->setCargo($row["cargo"]);
					$vetCandidatos[] = $candidato;
				}
				
				$this->desconectar();
				return $vetCandidatos;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
		
		public function consultarUsuarios($cand){
			$this->conectar();
			
			try{
				$retorno = '';
				$stmt = $this->conexao->query("SELECT * FROM candidato WHERE rg=" . $cand->getRg());
				
				$count = $stmt->rowCount();
				
				if($count != 0){
					// "Gente o rg existe";
					$retorno = 'rg';

				}else{

					$stmt = $this->conexao->query("SELECT * FROM candidato WHERE cpf=" . $cand->getCpf());
					
					$count = $stmt->rowCount();
					
					if($count != 0){
						// "Gente o cpf  existe";
						$retorno = 'cpf';
					}else{
					
						$stmt = $this->conexao->query("SELECT * FROM candidato WHERE email='" . $cand->getEmail()."'");
						
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
		
		public function consultarUsuariosAlterar($cand){
			$this->conectar();
			
			try{
				$retorno = '';
				$stmt = $this->conexao->query("SELECT * FROM candidato WHERE rg=" . $cand->getRg() . " AND codigo<>" .$cand->getCodigo());
				
				$count = $stmt->rowCount();
				
				if($count != 0){
					// "Gente o rg existe";
					$retorno = 'rg';

				}else{

					$stmt = $this->conexao->query("SELECT * FROM candidato WHERE cpf=" . $cand->getCpf() . " AND codigo<>" .$cand->getCodigo());
					
					$count = $stmt->rowCount();
					
					if($count != 0){
						// "Gente o cpf  existe";
						$retorno = 'cpf';
					}else{
					
						$stmt = $this->conexao->query("SELECT * FROM candidato WHERE email='" . $cand->getEmail()."'  AND codigo<>" .$cand->getCodigo());
						
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
		
		public function alterar($candidato){
			$this->conectar(); 
			
			try{
				//montando a query
				$stmt = $this->conexao->prepare("UPDATE candidato SET nome=?, rg=?, expeditor=?, cpf=?, data_nascimento=?, email=?, senha=?, 
										escolaridade=?, telefone=?, rua=?, numero=?, cep=?, bairro=?, 
										cidade=?, estado=?, complemento=? WHERE codigo = " . $candidato->getCodigo());
				// sequencia de parametros para o lugar dos ?
				$stmt->bindValue(1, $candidato->getNome());
				$stmt->bindValue(2, $candidato->getRg());
				$stmt->bindValue(3, $candidato->getExpeditor());
				$stmt->bindValue(4, $candidato->getCpf());
				$stmt->bindValue(5, $candidato->getData_nascimento());
				$stmt->bindValue(6, $candidato->getEmail());
				$stmt->bindValue(7, $candidato->getSenha());
				$stmt->bindValue(8, $candidato->getEscolaridade());
				$stmt->bindValue(9, $candidato->getTelefone());
				$stmt->bindValue(10, $candidato->getRua());
				$stmt->bindValue(11, $candidato->getNumero());
				$stmt->bindValue(12, $candidato->getCep());
				$stmt->bindValue(13, $candidato->getBairro());
				$stmt->bindValue(14, $candidato->getCidade());
				$stmt->bindValue(15, $candidato->getEstado());
				$stmt->bindValue(16, $candidato->getComplemento());

				
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