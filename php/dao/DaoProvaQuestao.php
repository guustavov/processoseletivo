<?php
	require_once '../conexao/GerenciadorConexao.php';
	require_once '../classes/ProvaQuestao.php';
	
	class DaoProvaQuestao{
		private $conexao;
		
		private function conectar(){
			$gc = new GerenciadorConexao;
			$this->conexao = $gc->pegarConexao();
		}
		
		private function desconectar(){
			$this->conexao = null;
		}
		
		public function inserir($provaQuestao){		
			$this->conectar();
						
			try{
				//montando a query
				$stmt = $this->conexao->prepare("INSERT INTO prova_has_questao (prova_codigo, questao_codigo, numero_questao) VALUES  (? ,?, ?)");
				// sequencia de parametros para o lugar dos ?
				$stmt->bindValue(1, $provaQuestao->getProva_codigo());
				$stmt->bindValue(2, $provaQuestao->getQuestao_codigo());
				$stmt->bindValue(3, $provaQuestao->getNumero());				
				
				//executando o query
				$resultado = $stmt->execute();
				$this->desconectar();
				return $resultado;
			}catch (PDOException $ex){
				echo ("Erro: ". $ex->getMessage());				
			}
		}
		
		public function gerarProva($codigoProva, $codigoQuestao){
			$this->conectar();
			
			try{
				$stmt = $this->conexao->query("select pq.*, q.*, d.disciplina from prova_has_questao pq INNER JOIN questao q ON pq.questao_codigo = q.codigo INNER JOIN disciplina d 
					ON q.disciplina_codigo = d.codigo WHERE prova_codigo =" .$codigoProva ." AND pq.numero_questao >= ". $codigoQuestao." ORDER BY numero_questao LIMIT 6");
				$cont = 1;
				$vetProvaQues[] = null;

				foreach($stmt as $row){
					$prova_codigo = $row["prova_codigo"];
					$questao_codigo = $row["questao_codigo"];
					$numero_questao = $row["numero_questao"];
					$nivel_questao = $row["nivel"];
					$descricao = $row["descricao"];
					$a = $row["a"];
					$b = $row["b"];
					$c = $row["c"];
					$d = $row["d"];
					$disciplina = $row["disciplina"];
					$gabarito = $row["gabarito"];
					
					$vetProvaQues[] = array($prova_codigo, $questao_codigo, $numero_questao, $nivel_questao, $descricao, $a, $b, $c, $d, $disciplina, $gabarito);
					$cont++;
				}
				$this->desconectar();
				return $vetProvaQues;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
	}
?>