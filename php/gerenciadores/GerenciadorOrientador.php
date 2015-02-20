<?php
	require_once '../classes/Orientador.php';
	require_once '../dao/DaoOrientador.php';
	require_once '../dao/DaoCandidato.php';
	require_once "../login/protegePaginaAdmin.php"; 

	$gOrientador = new GerenciadorOrientador;

	class GerenciadorOrientador{
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
			$ori = new Orientador;
			$ori->setNome($_POST["nome"]);
			$ori->setRg($_POST["rg"]);
			$ori->setExpeditor($_POST["expeditor"]);
			$ori->setCpf($_POST["cpf"]);
			$ori->setEmail($_POST["email"]);
			$ori->setSenha($_POST["senha"]);
			
			$daoCand = new DaoCandidato;	
			$daoOri = new DaoOrientador;	
			
			$condBoolean = false;
			$condicaoCand = $daoCand->consultarUsuarios($ori);
			$condicaoOri = $daoOri->consultarUsuarios($ori);
			
			if($condicaoCand == ('rg') || $condicaoOri == ('rg')) { 
				$condBoolean = true;
				echo("<script>javascript:history.go(-1); alert('Este RG já existe.');</script>");	
				break;
			}			
			if($condicaoCand == ('cpf') || $condicaoOri == ('cpf')) { 
				$condBoolean = true;
				echo("<script>javascript:history.go(-1); alert('Este CPF já existe.')</script>");						
				break;
			} 
			if($condicaoCand == 'email' || $condicaoOri == ('email')) { 
				$condBoolean = true;
				echo("<script>javascript:history.go(-1); alert('Este e-mail já existe.')</script>");		
				break;
			} 
			
			
			if ($condBoolean == false){
				$res = $daoOri->inserir($ori);
					
				if($res = true){
					include_once '../consultas/consultaOri.php';
					echo ("<script>alert('Orientador inserido com sucesso.')</script>");
				}else{
					include_once '../consultas/consultaOri.php';
					echo ("<script>alert('Erro ao inserir orientador.')</script>");
				}
			}
		 }
		 
		 public function consultar(){
			$daoOri = new DaoOrientador;
			$vetOri = $daoOri->consultar();
			
			if(isset($vetOri)){
				//echo("voltaram itens do banco")
				$tipoRes = "tabela";
			}else{
				$tipoRes = "mensagem";
			}
			
			include_once '../consultas/consultaOrientador.php';
		 }
	
		 public function consultarFiltro(){
			
			$tipo = $_POST["tipo"];
			$valor = $_POST["campo"];
		 
			$daoOri = new DaoOrientador;
			$vetOri = $daoOri->consultarFiltro($tipo, $valor);
			
			if(isset($vetOri)){
				//echo("voltaram itens do banco")
				$tipoRes = "tabela";
			}else{
				$tipoRes = "mensagem";
			}
			
			include_once '../consultas/consultaFiltroOrientador.php';
		 }
		 
		  public function excluir(){
			$codigo = $_GET["codigo"];
			if(isset($codigo)){
				$daoOri = new DaoOrientador;
				$qtde = $daoOri->excluir($codigo);
				$this->consultar();
				
				if ($qtde != null){
					echo ("<script>alert('Orientador excluído com sucesso.')</script>");
				}else{
					echo ("<script>alert('Erro ao excluir orientador, este está vinculado ao grupo.')</script>");
				}
			}
		 }
		 
		  public function alterar(){
			
			$codigo = $_GET["codigo"];
	
			$daoOri = new DaoOrientador;
			$vetOri = $daoOri->consultarCodigo($codigo);
			
			if(isset($vetOri)){
				//echo("voltaram itens do banco")
				$tipoRes = "tabela";
			}else{
				$tipoRes = "mensagem";
			}
			
			include_once '../alteracoes/consultaAlterarOrientador.php';
		 }
		 
		 public function atualizar(){
			$ori = new Orientador;
			$ori->setCodigo($_POST["id"]);
			$ori->setNome($_POST["nome"]);
			$ori->setRg($_POST["rg"]);
			$ori->setExpeditor($_POST["expeditor"]);
			$ori->setCpf($_POST["cpf"]);
			$ori->setEmail($_POST["email"]);
			$ori->setSenha($_POST["senha"]);
			
			$daoCand = new DaoCandidato;	
			$daoOri = new DaoOrientador;	
			
			$condBoolean = false;
			$condicaoCand = $daoCand->consultarUsuarios($ori);
			$condicaoOri = $daoOri->consultarUsuariosAlterar($ori);
			
			if($condicaoCand == ('rg') || $condicaoOri == ('rg')) { 
				$condBoolean = true;
				echo("<script>javascript:history.go(-1); alert('Este RG já existe.');</script>");	
				break;
			}			
			if($condicaoCand == ('cpf') || $condicaoOri == ('cpf')) { 
				$condBoolean = true;
				echo("<script>javascript:history.go(-1); alert('Este CPF já existe.')</script>");						
				break;
			} 
			if($condicaoCand == 'email' || $condicaoOri == ('email')) { 
				$condBoolean = true;
				echo("<script>javascript:history.go(-1); alert('Este e-mail já existe.')</script>");		
				break;
			} 
			
			if ($condBoolean == false){
				$res = $daoOri->alterar($ori);
					
				if($res = true){
					$this->consultar();
					echo ("<script>alert('Orientador alterado com sucesso.')</script>");
				}else{
					$this->consultar();
					echo ("<script>alert('Erro ao alterar orientador.')</script>");
				}
			}
		}
	}
?>