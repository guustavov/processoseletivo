<?php
	$gLogin = new GerenciadorLogin;

	class GerenciadorLogin{
	
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
				echo("Nenhuma acao a ser processada." );
			}
		}

		public function processarAcao($acao){
			if($acao == "login"){
				$this->login();
			}else if ($acao == "logout"){
				$this->logout();
			}
		}

		public function login(){
		 
			include("../login/Seguranca.php");
			
			$seg = new Seguranca;
			
			$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
			$senha = (isset($_POST['senha'])) ? $_POST['senha'] : '';
			
			$seg2 = $seg->validaUsuario($usuario, $senha);
			
			if ($seg2 == "admin") {
				header("Location: ../principais/adminpage.php");
			} else if ($seg2 == "ori") {
				header("Location: ../principais/oripage.php");
			}else if ($seg2 == "cand") {
				header("Location: ../principais/candpage.php");
			}else {
				$seg->fecharSessao();
			}
		 }
		 
		 public function logout(){
			include("../login/Seguranca.php");
			
			$seg =  new Seguranca;
			
			$seg->fecharSessao();
			
		 }
	}


?>
