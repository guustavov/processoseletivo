<?php

	require_once '../classes/Prova.php';
	require_once '../classes/ProvaQuestao.php';
	require_once '../classes/Grupo.php';	
	require_once '../classes/CandidatoGrupo.php';	
	require_once '../classes/Candidato.php';	
	require_once '../dao/DaoProva.php';	
	require_once '../dao/DaoProvaQuestao.php';
	require_once '../dao/DaoGrupo.php';
	require_once '../dao/DaoCandidatoGrupo.php';
	require_once '../dao/DaoCandidato.php';
	require_once '../dao/DaoQuestao.php';


	$gGrupo = new GerenciadorGrupo;

	class GerenciadorGrupo{
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
			}else if($acao == "gerarProva"){
				$this->gerarProva();
			}else if($acao == "continuarProva"){
				$this->continuarProva();
			}else if($acao == "terminarProva"){
				$this->terminarProva();
			}else if($acao == "consultarClassificacao"){
				$this->consultarClassificacao();
			}
		}
		
		public function cadastrar(){

			$vetDisci = $_POST['disciplinas'];
			
			$daoCand = new DaoCandidato();		
			$cargo = str_replace(" 2015", "", $_POST["nome"]);
			$vetCandSele = $daoCand->consultarCargo($cargo);
			
			$prova = new Prova;

			for ($contFacil = 1; $contFacil <= $_POST["codigo"]; $contFacil++){
				if ($_POST["qntdFacil".$contFacil] != null){
					$vetFacil[] = $_POST["qntdFacil".$contFacil];
				}
			//	echo $_POST["qntdFacil".$contFacil]."/Contador:".$contFacil."<br>";
			}

			for ($contMedio = 1; $contMedio <= $_POST["codigo"]; $contMedio++){
				if ($_POST["qntdMedio".$contMedio] != null){
					$vetMedio[] = $_POST["qntdMedio".$contMedio];
				}
			//	echo $_POST["qntdFacil".$contMedio]."/Contador:".$contMedio."<br>";
			}

			for ($contDificil = 1; $contDificil <= $_POST["codigo"]; $contDificil++){
				if ($_POST["qntdDificil".$contDificil] != null){
					$vetDificil[] = $_POST["qntdDificil".$contDificil];
				}
			//	echo $_POST["qntdFacil".$contDificil]."/Contador:".$contDificil."<br>";
			}
		
			if((isset($vetFacil)) OR (isset($vetMedio)) OR (isset($vetDificil))){
		
				if(isset($_POST["nome"])){
				
					if(isset($vetCandSele[0])){
							
						$prova->setNome("Prova: " . $_POST["nome"]);
						$prova->setData_criacao(date("Y-m-d"));
						
							$data_realizacao = $_POST["data_realizacao"];
							$dia = substr($data_realizacao, 0, 2);
							$mes = substr($data_realizacao, 3, 2);
							$ano = substr($data_realizacao, 6, 10);

						$prova->setData_realizacao($ano . "-" . $mes . "-" . $dia . " " . $_POST["hora"] .":". $_POST["minutos"] . ":00");
						$prova->setDuracao($_POST["duracao"]);
										
						$daoProva = new DaoProva;
						$daoQues = new DaoQuestao;

						$daoProva->inserir($prova);
						$totalProva = $daoProva->contarProva();
														
						$provaQues = new ProvaQuestao;	
						$daoProvaQues = new DaoProvaQuestao;
						
						$contadorGeral = 1;

						foreach ($vetDisci as $item){
							$provaQues->setProva_codigo($totalProva);
							if($_POST["qntdFacil".$item] != 0){
								$vetQues = $daoQues->consultarNivelDisci("Fácil", $item, $_POST["qntdFacil".$item]);
								foreach ($vetQues as $item2){
									$provaQues->setQuestao_codigo($item2);
									$provaQues->setNumero($contadorGeral);;
									$daoProvaQues->inserir($provaQues);
									$contadorGeral++;
								}
							}
							if($_POST["qntdMedio".$item] != 0){
								$vetQues = $daoQues->consultarNivelDisci("Médio", $item, $_POST["qntdMedio".$item]);
								foreach ($vetQues as $item2){
									$provaQues->setQuestao_codigo($item2);
									$provaQues->setNumero($contadorGeral);;
									$daoProvaQues->inserir($provaQues);
									$contadorGeral++;
								}
							} 
							if($_POST["qntdDificil".$item] != 0){
								$vetQues = $daoQues->consultarNivelDisci("Difícil", $item, $_POST["qntdDificil".$item]);
								foreach ($vetQues as $item2){
									$provaQues->setQuestao_codigo($item2);
									$provaQues->setNumero($contadorGeral);;
									$daoProvaQues->inserir($provaQues);
									$contadorGeral++;
								}
							}

					}

								
						$grupo = new Grupo;
							
						session_start();
						$grupo->setNome($_POST["nome"]);
						$grupo->setOrientador_codigo($_SESSION["usuarioID"]);
						$grupo->setProva_codigo($totalProva);	
						
						
						$daoGrupo = new DaoGrupo;			
						$res = $daoGrupo->inserir($grupo);
						
						$totalGrupo = $daoGrupo->contarGrupo();
						
						$daoCandGrupo = new DaoCandidatoGrupo();
						$cont = 0;
						
						
						foreach ($vetCandSele as $item){
							$candGrupo = new CandidatoGrupo();
							$candGrupo->setCandidato_codigo($item->getCodigo());
							$candGrupo->setGrupo_codigo($totalGrupo);
							$daoCandGrupo->inserir($candGrupo);
						}
						if($res = true){
							echo ("Grupo inserido com sucesso.");
							$this->consultarCodigo($totalGrupo);

						}else{
							echo("Erro ao inserir o grupo no banco de dados.");
							include_once '../cadastros/cadastraGrup.php';
						}
						
				}else{
					echo("<script>javascript:history.go(-1); alert('Não é possível cadastrar grupo sem candidatos.')</script>");
				}
			}else{
				echo("<script>javascript:history.go(-1); alert('Não é possível cadastrar grupo sem nome.')</script>");
			}
		  	}else{
		  		echo("<script>javascript:history.go(-1); alert('Não foram adicionadas questões à prova.')</script>");
		  	}
		}
		
		public function consultar(){
			$daoGrupo = new DaoGrupo;
			$vetGrupo = $daoGrupo->consultar();
			
			if(isset($vetGrupo)){
				//echo("voltaram itens do banco")
				$tipoRes = "tabela";
			}else{
				$tipoRes = "mensagem";
			}
			
			include_once '../consultas/consultaGrupo.php';
		 }
		 
		 public function consultarCodigo($codigo){

			$daoGrupo = new DaoGrupo;
			$vetGrupo = $daoGrupo->consultarCodigo($codigo);
						
			if(isset($vetGrupo)){
				//echo("voltaram itens do banco")
				$tipoRes = "tabela";
			}else{
				$tipoRes = "mensagem";
			}
			
			include_once '../consultas/consultaCodigoGrupo.php';
		 }
		 
		 public function consultarFiltro(){
			
			$tipo = $_POST["tipo"];
			$valor = $_POST["campo"];

			$daoGrupo = new DaoGrupo;
			$vetGrupo = $daoGrupo->consultarFiltro($tipo, $valor);
						
			if(isset($vetGrupo)){
				//echo("voltaram itens do banco")
				$tipoRes = "tabela";
			}else{
				$tipoRes = "mensagem";
			}
			
			include_once '../consultas/consultaFiltroGrupo.php';
		 }		

		public function gerarProva(){
		
			$daoCandGrupo = new DaoCandidatoGrupo;
			$codigoProva = $daoCandGrupo->consultaGrupo($_POST["codigo_candidato"]);
			
			$codigoQuestao = 1;
			
			$daoProvaQues = new DaoProvaQuestao;
			$vetProvaQues = $daoProvaQues->gerarProva($codigoProva, $codigoQuestao);
			
			if(isset($vetProvaQues)){
				//echo("voltaram itens do banco")
				$tipoRes = "tabela";
			}else{
				$tipoRes = "mensagem";
			}
			
			include_once '../consultas/consultaGerarProva.php';
		 }
		 
		 public function continuarProva(){
			$proxima = $_POST['proximaQuestao'];
			$primeira = $_POST['primeiraQuestao'];
			$ultima = $_POST['ultimaQuestao'];
			$codigoProva = $_POST['codigoProva'];
			
			$gabarito = $_POST['gab'];
			
			$cont = $primeira;
			session_start();	
			
			 if (!isset($_SESSION["gabarito"])){
				$_SESSION["gabarito"] = null;
			 }
			
			$_SESSION["gabarito"] = $_SESSION["gabarito"] . $gabarito;
			
			 if (!isset($_SESSION["vetRadio"])){
				$_SESSION["vetRadio"] = null;
			 }
		
			while ($cont <= $ultima){
				if(!isset($_POST['respostaCandidato'.$codigoProva.'e'.$cont.''])){
					$_SESSION["vetRadio"] = $_SESSION['vetRadio'] . "x";
					$cont ++;	
				}else{
					$_SESSION["vetRadio"] = $_SESSION['vetRadio'] . $_POST['respostaCandidato'.$codigoProva.'e'.$cont.''];
					$cont ++;
				}
			}
			
			$daoProvaQues = new DaoProvaQuestao;
			$vetProvaQues = $daoProvaQues->gerarProva($codigoProva, $proxima);
			
			if(isset($vetProvaQues)){
				//echo("voltaram itens do banco")
				$tipoRes = "tabela";
			}else{
				$tipoRes = "mensagem";
			}
			
			
			include_once '../consultas/consultaGerarProva.php';	
			
		 }
		 
		  public function terminarProva(){
			$primeira = $_POST['primeiraQuestao'];
			$ultima = $_POST['ultimaQuestao'];
			$codigoProva = $_POST['codigoProva'];
			
			$gabarito = $_POST['gab'];
			
			$cont = $primeira;
			session_start();	
			
			 if (!isset($_SESSION["gabarito"])){
				$_SESSION["gabarito"] = null;
			 }
			
			$_SESSION["gabarito"] = $_SESSION["gabarito"] . $gabarito;
			
			 if (!isset($_SESSION["vetRadio"])){
				$_SESSION["vetRadio"] = null;
			 }
		
			while ($cont <= $ultima){
				if(!isset($_POST['respostaCandidato'.$codigoProva.'e'.$cont.''])){
					$_SESSION["vetRadio"] = $_SESSION['vetRadio'] . "x";
					$cont ++;	
				}else{
					$_SESSION["vetRadio"] = $_SESSION['vetRadio'] . $_POST['respostaCandidato'.$codigoProva.'e'.$cont.''];
					$cont ++;
				}
			}
			
			$daoCandidatoGrupo = new DaoCandidatoGrupo;
			
			$acertos = $this->gerarClassificacao($_SESSION["gabarito"], $_SESSION["vetRadio"]);
			
			$daoCandidatoGrupo->alterar($_SESSION["vetRadio"], $_SESSION["usuarioID"], $acertos);
			
			include_once '../detalhes/fimProva.php';
			
		 }
		 
		 public function gerarClassificacao($gabarito, $respostaCandidato){
			
			$total =  strlen($gabarito);
			$total = $total -1;
			$acertos = 0;
			
			for ($cont = 0; $cont <= $total; $cont++){
				if ($gabarito{$cont} == $respostaCandidato{$cont}){
					$acertos = $acertos + 1;
				}
			}
			
			return $acertos;
		}	

		public function consultarClassificacao(){
			$grupo = $_POST['grupo'];
			
			$daoCandGrupo = new DaoCandidatoGrupo;
			$vetClassificacao = $daoCandGrupo->consultarClassificacao($grupo);
			
			if(isset($vetClassificacao)){
				//echo("voltaram itens do banco")
				$tipoRes = "tabela";
			}else{
				$tipoRes = "mensagem";
			}
			
			include_once '../consultas/consultaClassificacao.php';	
			
		}
		
	}
?>