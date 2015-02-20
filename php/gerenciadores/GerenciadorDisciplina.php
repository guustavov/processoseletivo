<?php
	require_once '../classes/Disciplina.php';
	require_once '../dao/DaoDisciplina.php';
	require_once "../login/protegePaginaAdmin.php"; 

	$gDisciplina = new gerenciadorDisciplina;

	class GerenciadorDisciplina{
	
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
			}else if($acao == "alterar"){
				$this->alterar();
			}else if($acao == "atualizar"){
				$this->atualizar();
			}
		}
		
		 public function cadastrar(){
		 
			$disc = new Disciplina;
			$disc->setDisciplina($_POST["disciplina"]);			
			
			$daoDisc = new DaoDisciplina;	
			$resDisc = $daoDisc->inserir($disc);
						
			if($resDisc == true){
				include_once '../cadastros/cadastraDisci.php';
				echo ("<script>alert('Disciplina inserida com sucesso.')</script>");
			}else{
				include_once '../cadastros/cadastraDisci.php';
				echo ("<script>alert('Disciplina já existente.')</script>");
			}
			
		 }
		 
		 public function consultar(){
			$daoDisci = new DaoDisciplina;
			$vetDisci = $daoDisci->consultar();
			
			if(isset($vetDisci)){
				//echo("voltaram itens do banco")
				$tipoRes = "tabela";
			}else{
				$tipoRes = "mensagem";
			}
			
			include_once '../consultas/consultaDisciplina.php';
		 }
		 
		public function alterar(){
			
			$codigo = $_GET["codigo"];
	
			$daoDisci = new DaoDisciplina;
			$cond = $daoDisci->verificarCadastro($codigo);
			
			if ($cond == true){
				$vetDisci = $daoDisci->consultarCodigo($codigo);
							
				if(isset($vetDisci)){
					//echo("voltaram itens do banco")
					$tipoRes = "tabela";
				}else{
					$tipoRes = "mensagem";
				}
				
				include_once '../alteracoes/consultaAlterarDisciplina.php';
			}else{
				$this->consultar();
				echo("<script>alert('Não é possível alterar essa disciplina.');</script>");	
			}
		}
		 
		public function atualizar(){
			$disci = new Disciplina;
			$disci->setCodigo($_POST["codigo"]);
			$disci->setDisciplina($_POST["disciplina"]);
			
			$daoDisci = new DaoDisciplina;
			$condicao = $daoDisci->consultarAlterar($disci);
			
			if($condicao == true){
				echo("<script>javascript:history.go(-1); alert('Esta disciplina já existe.');</script>");	
				break;
			}else{
				$res = $daoDisci->alterar($disci);
					
				if($res = true){
					$this->consultar();
					echo ("<script>alert('Disciplina alterada com sucesso.')</script>");
				}else{
					$this->consultar();
					echo ("<script>alert('Disciplina já existente.')</script>");					
				}
			}
			
		}
	}
	
?>