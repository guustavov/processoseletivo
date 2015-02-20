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
			$('document').ready(function(){
			
				$('input:text').hide();
				
				$('input:radio').bind('click', tipo);
				
				function tipo(){
					var id = $(this).attr('id');					
					$('input:text').hide();
					$('input:text').val('');
					$('#campo'+id).show();	
					$('#campo'+id).attr('name','campo');	
					
					
				}
			});
		</script>
	</head>
	<body onselectstart="return false">
		<div id="externa">
		
			<div id="cabecalho">
				<?php
					include("../login/protegePaginaAdmin.php"); 
					
					include ("../../html/cabecalho.html");
				?>
			</div>
			
			<div id="menuLateral">
				<?php
				include ("../../html/menuadmin.html");
				?>
			</div>
			
			<div id="conteudo">
				<h2>Consulta Disciplina</h2>
				<form action="../gerenciadores/GerenciadorDisciplina.php" method="POST">
					
					<input class="consultaGeral" type="submit" value="Consulta Geral" /><br><br>
					<input type="hidden" name="acao" value="consultar">
					<hr>
				</form>
			</div>
			
				<div id="rodape">
				<?php
				include ("../../html/rodape.html");				
				?>
			</div>
		</div>
	</body>
</html>
