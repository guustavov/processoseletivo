<?php
	require_once '../conexao/GerenciadorConexao.php';
	require_once '../classes/CandidatoGrupo.php';
	
	class DaoCandidatoGrupo{
		private $conexao;
		
		private function conectar(){
			$gc = new GerenciadorConexao;
			$this->conexao = $gc->pegarConexao();
		}
		
		private function desconectar(){
			$this->conexao = null;
		}
		
		public function inserir($candidatoGrupo){		
			$this->conectar();
						
			try{
				//montando a query
				$stmt = $this->conexao->prepare("INSERT INTO candidato_has_grupo (candidato_codigo, grupo_codigo, resposta_candidato) VALUES  (? ,?, ?)");
				// sequencia de parametros para o lugar dos ?
				$stmt->bindValue(1, $candidatoGrupo->getCandidato_codigo());
				$stmt->bindValue(2, $candidatoGrupo->getGrupo_codigo());
				$stmt->bindValue(3, $candidatoGrupo->getResposta_candidato());				
				
				//executando o query
				$resultado = $stmt->execute();
				$this->desconectar();
				return $resultado;
			}catch (PDOException $ex){
				echo ("Erro: ". $ex->getMessage());				
			}
		}
		
		public function consultaPosCadastro($grupo){		
			$this->conectar();
			try{
				$stmt = $this->conexao->query("select cg.*, c.nome as nome_candidato, g.nome as nome_grupo from candidato_has_grupo cg INNER JOIN candidato c ON cg.candidato_codigo = c.codigo INNER JOIN grupo g ON cg.grupo_codigo = g.codigo WHERE g.nome = '" . $grupo . "'");
				
				foreach($stmt as $row){
					$candGrupo = new CandidatoGrupo;
					$candGrupo->setCandidato_codigo($row["candidato_codigo"]);
					$candGrupo->setGrupo_codigo($row["grupo_codigo"]);
					$candGrupo->setNome_candidato($row["nome_candidato"]);
					$candGrupo->setNome_grupo($row["nome_grupo"]);
					$vetCandGrupo[] = $candGrupo;
				}
				$this->desconectar();
				return $vetCandGrupo;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
		
		public function contarGrupoCodigo($valor){
			$this->conectar();
			
			try{
				$stmt = $this->conexao->query("SELECT COUNT(grupo_codigo) FROM candidato_has_grupo WHERE grupo_codigo = ".$valor);
				
				foreach($stmt as $row){
					$valor = $row["COUNT(grupo_codigo)"];
				}
				
				$this->desconectar();
				return $valor;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
		
		public function consultaGrupo($codigo_candidato){		
			$this->conectar();
			try{
				$stmt = $this->conexao->query("select g.prova_codigo from candidato c INNER JOIN candidato_has_grupo cg ON c.codigo = cg.candidato_codigo INNER JOIN grupo g ON cg.grupo_codigo = g.codigo AND c.codigo = " . $codigo_candidato);
				$codigo = 0;
				
				foreach($stmt as $row){					
					$codigo = $row["prova_codigo"];
				}

				$this->desconectar();
				return $codigo;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
		
		public function alterar($valor, $candidato_codigo, $acertos){
			$this->conectar(); 
			
			try{
				//montando a query
				$stmt = $this->conexao->prepare("UPDATE candidato_has_grupo SET resposta_candidato='".$valor."', acertos = ".$acertos." WHERE candidato_codigo = " . $candidato_codigo);		

				$resultado = $stmt->execute();
				$this->desconectar();
				return $resultado;
			}catch (PDOException $ex){
				echo ("Erro: ". $ex->getMessage());				
			}
		}	
		
		public function consultarClassificacao($codigo_grupo){
			$this->conectar();
			
			try{
				$stmt = $this->conexao->query("select g.nome as nome_grupo, c.nome as candidato_nome, cg.acertos from candidato_has_grupo cg INNER JOIN grupo g ON g.codigo = cg.grupo_codigo INNER JOIN candidato c 
						ON c.codigo = cg.candidato_codigo WHERE g.codigo = ".$codigo_grupo ." AND cg.resposta_candidato <> 'null' ORDER BY cg.acertos DESC");
				
				$cont = 1;
				$vetClassificacao[] = null;

				foreach($stmt as $row){
					$grupo_nome = $row["nome_grupo"];
					$candidato_nome = $row["candidato_nome"];
					$acertos = $row["acertos"];
					
					$vetClassificacao[] = array($grupo_nome, $candidato_nome, $acertos);
					$cont++;
				}
				
				$this->desconectar();
				return $vetClassificacao;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
		

	}
?>