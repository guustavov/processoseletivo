<?php
	require_once '../classes/Cargo.php';
	require_once '../dao/DaoCargo.php';
	require_once "../login/protegePaginaAdmin.php"; 

	$gCargo = new gerenciadorCargo;

	class GerenciadorCargo{
	
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
		 
			$carg = new Cargo;
			$carg->setCargo($_POST["cargo"]);			
			
			$daoCarg = new DaoCargo;	
			$resCarg = $daoCarg->inserir($carg);
			
			if($resCarg == true){
				include_once '../cadastros/cadastraCarg.php';
				echo ("<script>alert('Cargo inserido com sucesso.')</script>");
			}else{
				include_once '../cadastros/cadastraCarg.php';
				echo ("<script>alert('Cargo já existente.')</script>");
			}
			
		 }
		 
		 public function consultar(){
			$daoCarg = new DaoCargo;
			
			$vetCarg = $daoCarg->consultar();
			
			if(isset($vetCarg)){
				//echo("voltaram itens do banco")
				$tipoRes = "tabela";
			}else{
				$tipoRes = "mensagem";
			}
			
			include_once '../consultas/consultaCargo.php';
		 }
		 
		public function alterar(){
			
			$codigo = $_GET["codigo"];
	
			$daoCarg = new DaoCargo;
			$cond = $daoCarg->verificarCadastro($_GET["cargo"]);
			
			if ($cond == true){
			
				$vetCarg = $daoCarg->consultarCodigo($codigo);
				
				if(isset($vetCarg)){
					//echo("voltaram itens do banco")
					$tipoRes = "tabela";
				}else{
					$tipoRes = "mensagem";
				}
				
				include_once '../alteracoes/consultaAlterarCargo.php';
			} else{
				
				$this->consultar();
				echo("<script>alert('Não é possível alterar esse cargo.');</script>");	
			}
		 }
		 
		public function atualizar(){
			$carg = new Cargo;
			$carg->setCodigo($_POST["codigo"]);
			$carg->setCargo($_POST["cargo"]);
			
			$daoCarg = new DaoCargo;
			$condicao = $daoCarg->consultarAlterar($carg);
			
			if($condicao == true){
				echo("<script>javascript:history.go(-1); alert('Este cargo já existe.');</script>");	
				break;
			}else{
			
				$res = $daoCarg->alterar($carg);
				
				if($res = true){
					$this->consultar();
					echo ("<script>alert('Cargo alterado com sucesso.')</script>");
				}else{
					$this->consultar();
					echo ("<script>alert('Cargo já existente.')</script>");
				}
			}
		}
	}
	
?>