<?php
	require_once '../classes/Candidato.php';
	require_once '../classes/CandidatoGrupo.php';
	require_once '../dao/DaoCandidato.php';
	require_once '../dao/DaoOrientador.php';
	require_once '../dao/DaoCandidatoGrupo.php';

	$gCandidato = new GerenciadorCandidato;

	class GerenciadorCandidato{
	
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
			}else if($acao == "atualizar2"){
				$this->atualizar2();
			}
		}
		
		 public function cadastrar(){
		 	$data_nascimento = $_POST["data_nascimento"];
		 	$dia = substr($data_nascimento, 0, 2);
		 	$mes = substr($data_nascimento, 3, 2);
		 	$ano = substr($data_nascimento, 6, 10);

			$cand = new Candidato;
			$cand->setNome($_POST["nome"]);
			$cand->setRg($_POST["rg"]);
			$cand->setExpeditor($_POST["expeditor"]);
			$cand->setCpf($_POST["cpf"]);
			$cand->setData_nascimento($ano."-".$mes."-".$dia);
			$cand->setEmail($_POST["email"]);
			$cand->setSenha($_POST["senha"]);
			$cand->setCargoCodigo($_POST["cargo"]);
			$cand->setEscolaridade($_POST["escolaridade"]);
			$cand->setTelefone($_POST["telefone"]);
			$cand->setCep($_POST["cep"]);
			$cand->setRua($_POST["rua"]);
			$cand->setNumero($_POST["numero"]);
			$cand->setBairro($_POST["bairro"]);
			$cand->setCidade($_POST["cidade"]);
			$cand->setEstado($_POST["uf"]);
			$cand->setComplemento($_POST["complemento"]);
						
			$daoCand = new DaoCandidato;	
			$daoOri = new DaoOrientador;	
			
			$condBoolean = false;
			$condicaoCand = $daoCand->consultarUsuarios($cand);
			$condicaoOri = $daoOri->consultarUsuarios($cand);
			
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
			
			
			if (($condBoolean == false)){
				$resCand = $daoCand->inserir($cand);
						
				if($resCand == true){
					include_once '../cadastros/cadastraCand.php';
					echo (" <script>alert('Candidato inserido com sucesso.')</script>");
				}else{
					include_once '../cadastros/cadastraCand.php';
					echo ("<script>alert('Erro ao inserir candidato.')</script>");

				}
			}
		 }
		 
		public function consultar(){
			$daoCand = new DaoCandidato;
			$vetCand = $daoCand->consultar();
					
			if(isset($vetCand)){
				//echo("voltaram itens do banco")
				$tipoRes = "tabela";
			}else{
				$tipoRes = "mensagem";
			}
			
			include_once '../consultas/consultaCandidato.php';
		 }
		 
		public function consultarFiltro(){
			
			$tipo = $_POST["tipo"];
			$valor = $_POST["campo"];
					 
			$daoCand = new DaoCandidato;
			$vetCand = $daoCand->consultarFiltro($tipo, $valor);
						
			if(isset($vetCand)){
				//echo("voltaram itens do banco")
				$tipoRes = "tabela";
			}else{
				$tipoRes = "mensagem";
			}
			
			include_once '../consultas/consultaFiltroCandidato.php';
		 }
		 
		public function excluir(){
			$codigo = $_GET["codigo"];
			if(isset($codigo)){
				$daoCand = new DaoCandidato;
				$qtde = $daoCand->excluir($codigo);
				$this->consultar();
				if ($qtde != null){
					echo ("<script>alert('Excluído com sucesso.')</script>");
				}else{
					echo ("<script>alert('Erro ao excluir candidato.')</script>");
				}
			}
		 }
		 
		public function alterar(){
			
			$codigo = $_GET["codigo"];
	
			$daoCand = new DaoCandidato;
			$vetCand = $daoCand->consultarCodigo($codigo);
			
			if(isset($vetCand)){
				//echo("voltaram itens do banco")
				$tipoRes = "tabela";
			}else{
				$tipoRes = "mensagem";
			}
			
			if (isset($_GET["link"])){
				include_once '../alteracoes/consultaAutoAlterarCandidato.php';
			}else{
				include_once '../alteracoes/consultaAlterarCandidato.php';
			}
		
		 }
		 		 
		public function atualizar(){

			$data_nascimento = $_POST["data_nascimento"];
		 	$dia = substr($data_nascimento, 0, 2);
		 	$mes = substr($data_nascimento, 3, 2);
		 	$ano = substr($data_nascimento, 6, 10);

			$cand = new Candidato;
			$cand->setCodigo($_POST["id"]);
			$codigo = $cand->getCodigo();
			$cand->setNome($_POST["nome"]);
			$cand->setRg($_POST["rg"]);
			$cand->setExpeditor($_POST["expeditor"]);
			$cand->setCpf($_POST["cpf"]);
			$cand->setData_nascimento($ano."-".$mes."-".$dia);
			$cand->setEmail($_POST["email"]);
			$cand->setSenha($_POST["senha"]);
			$cand->setEscolaridade($_POST["escolaridade"]);
			$cand->setTelefone($_POST["telefone"]);
			$cand->setCep($_POST["cep"]);
			$cand->setRua($_POST["rua"]);
			$cand->setNumero($_POST["numero"]);
			$cand->setBairro($_POST["bairro"]);
			$cand->setCidade($_POST["cidade"]);
			$cand->setEstado($_POST["uf"]);
			$cand->setComplemento($_POST["complemento"]);
			
			$daoCand = new DaoCandidato;	
			$daoOri = new DaoOrientador;	
			
			$condBoolean = false;
			$condicaoCand = $daoCand->consultarUsuariosAlterar($cand);
			$condicaoOri = $daoOri->consultarUsuarios($cand);
			
			if(($condicaoCand == 'rg' || $condicaoOri =='rg')) { 
				$condBoolean = true;
				echo("<script>javascript:history.go(-1); alert('Este RG já existe.')</script>");	
				break;
			}
			if(($condicaoCand == 'cpf' || $condicaoOri =='cpf')) { 
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
				$res = $daoCand->alterar($cand);
					
				if($res = true){	
				
					$this->consultar();	
					echo ("<script>alert('Candidato alterado com sucesso.')</script>");
				}else{
					
					$this->consultar();	
					echo("<script>alert('Erro ao alterar o candidato.')</script>");
				}
			}
		}
		
		public function atualizar2(){

			$data_nascimento = $_POST["data_nascimento"];
		 	$dia = substr($data_nascimento, 0, 2);
		 	$mes = substr($data_nascimento, 3, 2);
		 	$ano = substr($data_nascimento, 6, 10);
		 	
			$cand = new Candidato;
			$cand->setCodigo($_POST["id"]);
			$codigo = $cand->getCodigo();
			$cand->setNome($_POST["nome"]);
			$cand->setRg($_POST["rg"]);
			$cand->setExpeditor($_POST["expeditor"]);
			$cand->setCpf($_POST["cpf"]);
			$cand->setData_nascimento($ano."-".$mes."-".$dia);
			$cand->setEmail($_POST["email"]);
			$cand->setSenha($_POST["senha"]);
			$cand->setEscolaridade($_POST["escolaridade"]);
			$cand->setTelefone($_POST["telefone"]);
			$cand->setCep($_POST["cep"]);
			$cand->setRua($_POST["rua"]);
			$cand->setNumero($_POST["numero"]);
			$cand->setBairro($_POST["bairro"]);
			$cand->setCidade($_POST["cidade"]);
			$cand->setEstado($_POST["uf"]);
			$cand->setComplemento($_POST["complemento"]);
			
			$daoCand = new DaoCandidato;	
			$daoOri = new DaoOrientador;	
			
			$condBoolean = false;
			$condicaoCand = $daoCand->consultarUsuariosAlterar($cand);
			$condicaoOri = $daoOri->consultarUsuarios($cand);
			
			if(($condicaoCand == 'rg' || $condicaoOri =='rg')) { 
				$condBoolean = true;
				echo("<script>javascript:history.go(-1); alert('Este RG já existe.')</script>");	
				break;
			}
			if(($condicaoCand == 'cpf' || $condicaoOri =='cpf')) { 
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
				$res = $daoCand->alterar($cand);
					
				if($res = true){	
						header("Location: ../principais/candpage.php");
					echo ("<script>alert('Candidato alterado com sucesso.')</script>");
				}else{
						header("Location: ../principais/candpage.php");
					echo("<script>alert('Erro ao alterar o candidato.')</script>");
				}
			}
		}
	}
?>