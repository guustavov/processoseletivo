<html>
	<head>
		<title>Administração</title>
		<link type="text/css" rel="stylesheet" href="../../css/estilo.css" />	
		 <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    
   		<script src= "../../javascript/jquery/jquery-1.8.2.min.js" ></script>
		<script src="../../javascript/jquery/jquery-ui-1.8.20.custom.min.js"></script>
    	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
		
		<script src="../../javascript/jquery/jquery.validate.js"></script>
		<script language="JavaScript" src="../../javascript/anticopia.js"></script>	
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
		<div class="container">
			
			<div id="cabecalho">
			<?php
				include ("../login/protegePaginaAdmin.php");
				
				include ("../../html/cabecalho.html");
			?>
					
			</div>
			
			<!--<div id='load'>
				<img id='imgLoad' src='../../imagens/ajax-loader.gif'>
			</div>-->
			<div class="row">
				<div class="col-sm-3 col-md-3" >
				
				<?php
					include ("../../html/menuadmin.html");
				?>
					
				</div>
				
				<div class="col-sm-9 col-md-9" >
					Bem-Vindo Administrador.
				</div>
			</div>
				<div id="rodape"> 
			<?php
				include ("../../html/rodape.html");				
			?>	
			</div>
		</div>
	</body>
</html> 