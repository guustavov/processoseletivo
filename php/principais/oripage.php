<html>
	<head>
		<title>Administração</title>
		<link type="text/css" rel="stylesheet" href="../../css/estilo.css" />
		<script src= "../../javascript/jquery/jquery-1.8.2.min.js" ></script>
		<script src="../../javascript/jquery/jquery-ui-1.8.20.custom.min.js"></script>
		<script src="../../javascript/jquery/jquery.validate.js"></script>
		<script language="JavaScript" src="../../javascript/anticopia.js">
		</script>	
		<script>
			$(document).ready(function(){
				var cont = 0;
				var intervalo = setInterval(function() { 
					cont++;
					if(cont > 1){
						$("#load").hide();
					}
				}, 1000);
				
			});
	</script>		
	</head>
	<body onselectstart="return false">
		<div id="externa">
		
			<div id="cabecalho">
			<?php								
				include ("../../html/cabecalho.html");
				
				include("../login/protegePaginaOri.php"); 
				
			?>
					
			</div>
			
			<div id='load'>
				<img id='imgLoad' src='../../imagens/ajax-loader.gif'>
			</div>
			
			<div id="menuLateral">
			
			<?php
				include ("../../html/menuori.html");
			?>
				
			</div>
			
			<div id="conteudo">
				
				Bem-Vindo <?php echo $_SESSION["usuarioNome"]?>.
			</div>
			
				<div id="rodape"> 
			<?php
				
				include ("../../html/rodape.html");	
			
			?>

			</div>
		</div>
	</body>
</html> 