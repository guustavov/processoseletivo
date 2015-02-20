<?php
	require_once '../conexao/GerenciadorConexao.php';
	require_once '../classes/Usuario.php';
	
	class DaoLogin{
		private $conexao;
		
		private function conectar(){
			$gc = new GerenciadorConexao;
			$this->conexao = $gc->pegarConexao();
		}
		
		private function desconectar(){
			$this->conexao = null;
		}

		public function consultarUsuario($usuario, $senha){
			$this->conectar();
					
			try{
				$stmt = $this->conexao->query("SELECT codigo, nome FROM administrador WHERE nome = '".$usuario."' AND senha = '".$senha."' ");
				
				$count = $stmt->rowCount();
				
				$cond= "admin";
				
				if($count == 0){
				
					$stmt = $this->conexao->query("SELECT codigo, nome, email FROM orientador WHERE email = '".$usuario."' AND senha = '".$senha."' ");
				
					$count = $stmt->rowCount();
					
					$cond= "ori";
					
					if($count == 0){
					
						$stmt = $this->conexao->query("SELECT c.codigo, c.nome, c.email FROM candidato c INNER JOIN candidato_has_grupo cg ON c.codigo = cg.candidato_codigo WHERE c.email = '".$usuario."' AND c.senha = '".$senha."' AND cg.resposta_candidato IS NULL ");
				
						$count = $stmt->rowCount();
						
						$cond= "cand";
					}
				}
				
				if ($count != 0)	
					foreach($stmt as $row){
						$usuario = new Usuario;
						$usuario->setCodigo($row["codigo"]);
						$usuario->setNome($row["nome"]);
						if(isset ($row["email"])){
							$usuario->setEmail($row["email"]);
						}
						$usuario->setTipo($cond);
						$vetUsuario[] = $usuario;
				}		
								
				$this->desconectar();
				return $vetUsuario;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
	}
?>