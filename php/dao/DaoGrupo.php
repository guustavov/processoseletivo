<?php
	require_once '../conexao/GerenciadorConexao.php';
	require_once '../classes/Grupo.php';
	
	class DaoGrupo{
		private $conexao;
		
		private function conectar(){
			$gc = new GerenciadorConexao;
			$this->conexao = $gc->pegarConexao();
		}
		
		private function desconectar(){
			$this->conexao = null;
		}
		
		public function inserir($grupo){		
			$this->conectar();
			
			try{
				//montando a query
				$stmt = $this->conexao->prepare("INSERT INTO grupo (codigo, nome, orientador_codigo, prova_codigo) VALUES (?, ?, ?, ?)");
				// sequencia de parametros para o lugar dos ?
				$stmt->bindValue(1, $grupo->getCodigo());
				$stmt->bindValue(2, $grupo->getNome());
				$stmt->bindValue(3, $grupo->getOrientador_codigo());
				$stmt->bindValue(4, $grupo->getProva_codigo());
				
				
				//executando o query
				$resultado = $stmt->execute();
				$this->desconectar();
				return $resultado;
			}catch (PDOException $ex){
				echo ("Erro: ". $ex->getMessage());				
			}
		}

		public function verificar($valor){
			$this->conectar();
			
			try{
				$stmt = $this->conexao->query("select * from grupo g WHERE g.nome = '".$valor."'");
				
				$count = $stmt->rowCount();
				
				if($count != 0){
					// "Gente a disci existe";
					$retorno = true;

				}else{
					$retorno = false;
				}
				
				$this->desconectar();
				return $retorno;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}

		public function consultar(){
			$this->conectar();
			$vetGrupos = array();
			try{
				$stmt = $this->conexao->query("select g.*, o.nome as orientador_nome from grupo g INNER JOIN orientador o ON g.orientador_codigo = o.codigo");
				
				foreach($stmt as $row){
					$Grupo = new Grupo;
					$Grupo->setCodigo($row["codigo"]);
					$Grupo->setNome($row["nome"]);
					$Grupo->setOrientador_codigo($row["orientador_codigo"]);
					$Grupo->setProva_codigo($row["prova_codigo"]);
					$Grupo->setOrientador_nome($row["orientador_nome"]);
					$vetGrupos[] = $Grupo;
				}
				
				$this->desconectar();
				return $vetGrupos;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
		
		public function consultarFiltro($tipo, $valor){
			$this->conectar();
			$vetGrupos = array();
			try{
				$stmt = $this->conexao->query("select g.*, o.nome as orientador_nome from grupo g INNER JOIN orientador o ON g.orientador_codigo = o.codigo WHERE ".$tipo." like '%".$valor."%'");
				
					foreach($stmt as $row){
					$Grupo = new Grupo;
					$Grupo->setCodigo($row["codigo"]);
					$Grupo->setNome($row["nome"]);
					$Grupo->setOrientador_codigo($row["orientador_codigo"]);
					$Grupo->setProva_codigo($row["prova_codigo"]);
					$Grupo->setOrientador_nome($row["orientador_nome"]);
					$vetGrupos[] = $Grupo;
				}
								
				$this->desconectar();
				return $vetGrupos;
				
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
		
		public function consultarCodigo($codigo){
			$this->conectar();
			$vetGrupos = array();
			try{
				$stmt = $this->conexao->query("select g.codigo, g.nome as nome_grupo, o.nome as orientador_nome, p.data_criacao, p.data_realizacao, c.nome as candidato_nome, cg.candidato_codigo from grupo g 
					INNER JOIN orientador o ON g.orientador_codigo = o.codigo INNER JOIN prova p ON g.prova_codigo = p.codigo INNER JOIN candidato_has_grupo cg ON g.codigo = cg.grupo_codigo 
					INNER JOIN candidato c ON cg.candidato_codigo = c.codigo WHERE g.codigo = ". $codigo);
					
				$cont = 1;
				$vetGrupos[] = null;

				foreach($stmt as $row){
					$data_criacao = $row["data_criacao"];
					$dia_c = substr($data_criacao, 8, 10);
					$mes_c = substr($data_criacao, 5, 2);
					$ano_c = substr($data_criacao, 0, 4);
					$data_criacao = $dia_c . "/" . $mes_c . "/" . $ano_c;
				
					$grupo_codigo = $row["codigo"];
					$grupo_nome = $row["nome_grupo"];
					$orientador_nome = $row["orientador_nome"];
					
					$candidato_nome = $row["candidato_nome"];
					$candidato_codigo = $row["candidato_codigo"];
					
					$data_realizacao = $row["data_realizacao"];
					$dia_r = substr($data_realizacao, 8, 10);
					$mes_r = substr($data_realizacao, 5, 2);
					$ano_r = substr($data_realizacao, 0, 4);
					$hora_r = substr($data_realizacao, 11, 19);
					$data_realizacao = $dia_c . "/" . $mes_c . "/" . $ano_c;
					
					$vetGrupos[] = array($grupo_codigo, $grupo_nome, $orientador_nome, $data_criacao, $candidato_nome, $candidato_codigo, $data_realizacao, $hora_r);
					$cont++;
				}
				$this->desconectar();
				return $vetGrupos;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
		
		public function contarGrupo(){
			$this->conectar();
			
			try{
				$stmt = $this->conexao->query("SELECT * FROM grupo ORDER BY codigo DESC LIMIT 1");
				
				foreach($stmt as $row){
					$valor = $row["codigo"];
				}
				
				$this->desconectar();
				return $valor;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
	}
?>