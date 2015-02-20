<?php
	require_once '../classes/Questao.php';
	require_once '../dao/DaoQuestao.php';
	require_once "../login/protegePaginaAdmin.php"; 

	$gQuestao = new GerenciadorQuestao;

	class GerenciadorQuestao{
		function __construct() {
			$acao = null;
			
			if(isset($_POST["acao"])){
				$acao = $_POST["acao"];
			}else if(isset($_GET["acao"])){
				$acao = $_GET["acao"];
			}
			
			if(isset($acao)){
				$this->processarAcao($acao);
			}else{
				echo("Nenhuma acao a ser processada.");
			}
		}

		public function processarAcao($acao){
			if($acao == "cadastrar"){
				$this->cadastrar();
			}else if($acao == "consultar"){
				$this->consultar();
			}else if($acao == "consultarFiltro"){
				$this->consultarFiltro();
			}else if($acao == "excluir"){
				$this->excluir();
			}else if($acao == "alterar"){
				$this->alterar();
			}else if($acao == "atualizar"){
				$this->atualizar();
			}
		}
		
		 public function cadastrar(){
		 
			$questao = new Questao;
			$questao->setDisciplinaCodigo($_POST["tipoQ"]);
			$questao->setNivel($_POST["nivelQ"]);
			$questao->setDescricao($_POST["descricaoQ"]);
			$questao->setA($_POST["a"]);
			$questao->setB($_POST["b"]);
			$questao->setC($_POST["c"]);
			$questao->setD($_POST["d"]);
			$questao->setGabarito($_POST["alternativaCorreta"]);
			
			$daoQuestao = new DaoQuestao;
			$vetQues = $daoQuestao->consultar();
			
			$res = $daoQuestao->inserir($questao);
				
			if($res = true){
				include "../cadastros/cadastraQues.php";
				echo ("<script>alert('Questão inserida com sucesso.')</script>");				
			}else{
				include "../cadastros/cadastraQues.php";
				echo ("<script>alert('Erro ao inserir questão.')</script>");				
			}
		 }
		 
		  public function consultar(){
			$daoQues = new DaoQuestao;
			$vetQues = $daoQues->consultar();
				
			if(isset($vetQues)){
				//echo("voltaram itens do banco")
				$tipoRes = "tabela";
			}else{
				$tipoRes = "mensagem";
			}
			
			include_once '../consultas/consultaQuestao.php';
		 }
		 
		public function consultarFiltro(){

			$tipo = $_POST["tipo"];
			
			if ($tipo == "disciplina_codigo"){
				$valor = $_POST["campo1"];
			} 
			if ($tipo == "nivel"){
				$valor = $_POST["campo2"];
			}
			if($tipo == "descricao"){
				$valor = $_POST["campo3"];
			}
			
			$daoQues = new DaoQuestao;
			$vetQues = $daoQues->consultarFiltro($tipo, $valor);
			
			if(isset($vetQues)){
				//echo("voltaram itens do banco")
				$tipoRes = "tabela";
			}else{
				$tipoRes = "mensagem";
			}
			
			include_once '../consultas/consultaFiltroQuestao.php';
		 }
		 
		   public function excluir(){
			$codigo = $_GET["codigo"];
			if(isset($codigo)){
				$daoQues = new DaoQuestao;
				$qtde = $daoQues->excluir($codigo);
				
				$this->consultar();
				if ($qtde != null){
					echo ("<script>alert('Questão excluída com sucesso.')</script>");				
				}else{
					echo ("<script>alert('Erro ao excluir questão.')</script>");
				}
			}
		 }
		 
		  public function alterar(){
			
			$codigo = $_GET["codigo"];
	
			$daoQues = new DaoQuestao;
			$vetQues = $daoQues->consultarCodigo($codigo);
			
			if(isset($vetQues)){
				//echo("voltaram itens do banco")
				$tipoRes = "tabela";
			}else{
				$tipoRes = "mensagem";
			}
			
			include_once '../alteracoes/consultaAlterarQuestao.php';
		 }
		 
		  public function atualizar(){
			$questao = new Questao;
			$questao->setCodigo($_POST["id"]);
			$questao->setDisciplinaCodigo($_POST["disciplina_codigo"]);
			$questao->setNivel($_POST["nivelQ"]);
			$questao->setDescricao($_POST["descricaoQ"]);
			$questao->setA($_POST["a"]);
			$questao->setB($_POST["b"]);
			$questao->setC($_POST["c"]);
			$questao->setD($_POST["d"]);
			$questao->setGabarito($_POST["alternativaCorreta"]);
			
			$daoQuestao = new DaoQuestao;
		
			$res = $daoQuestao->alterar($questao);
				
			if($res = true){
				$this->consultar();
				echo ("<script>alert('Questão alterada com sucesso.')</script>");
			}else{
				$this->consultar();
				echo ("<script>alert('Erro ao alterar questão.')</script>");				
			}
		}
				 
	}
?>