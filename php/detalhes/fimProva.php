<html>
	<head>
	<title>Consulta Geral</title>
	<link type="text/css" rel="stylesheet" href="../../css/estilo.css" />
	<script src= "../../javascript/jquery/jquery-1.8.2.min.js" ></script>
	<script src="../../javascript/jquery/jquery-ui-1.8.20.custom.min.js"></script>
	<script src= "../../javascript/jquery/escondeEndereco.js" ></script>
	<script src= "../../javascript/exclusaoCandidato.js" ></script>
	<script>
		$(document).ready(function(){
			$('.consulta tr:odd').addClass('par');
		});
	</script>
	<script>
		/*function naoDeixaSair() {
			return "Permane�a nessa p�gina, caso contr�rio sua prova poder� ser corrompida.";
		}
		window.onbeforeunload = naoDeixaSair;*/
	</script>
	</head>
	<body>	
		<div id="externa">
			<div id="cabecalho">
				
				<?php include ("../../html/cabecalho.html"); 
				
				require_once ("../login/Seguranca.php"); 
					$seg = new Seguranca;

					$seg->fecharSessaoSemAcesso(); 
				?>
				
			</div>	

			<div id="fimprova">
				Obrigado pela participa��o, esperamos que tenha um bom resultado. 
				Ser� enviado no seu email a classifica��o.
				
				
			</div>
			
			<div id="rodape">
				
				<?php include ("../../html/rodape.html");	?>			
					
			</div>
		</div>
	</body>
</html>
