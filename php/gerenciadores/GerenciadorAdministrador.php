<?php
	require_once '../classes/Administrador.php';
	require_once '../dao/DaoAdministrador.php';
	require_once "../login/protegePaginaAdmin.php"; 

	$gAdministrador = new GerenciadorAdministrador;

	class GerenciadorAdministrador{
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
			if($acao == "alterar"){
				$this->alterar();
			}else if($acao == "atualizar"){
				$this->atualizar();
			}
		}
		
		  public function alterar(){
			
			$codigo = $_POST["codigo"];
	
			$daoAdm = new DaoAdministrador;
			$vetAdm = $daoAdm->consultarCodigo($codigo);
			
			if(isset($vetAdm)){
				//echo("voltaram itens do banco")
				$tipoRes = "tabela";
			}else{
				$tipoRes = "mensagem";
			}
			
			include_once '../alteracoes/consultaAlterarAdministrador.php';
		 }
		 
		 public function atualizar(){
			$adm = new Administrador;
			$adm->setCodigo($_POST["id"]);
			$adm->setNome($_POST["nome"]);;
			$adm->setSenha($_POST["senha"]);
			
			$daoAdm = new DaoAdministrador;	
			
		
				$res = $daoAdm->alterar($adm);
								
				if($res = true){
					include_once '../login/acesso.php';
				}else{
					echo ("<script>alert('Erro ao alterar administrador.')</script>");
				}
				
				
		}
	}
?>