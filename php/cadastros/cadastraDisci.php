<html>
	<head>
		<title>Administração</title>
		<link type="text/css" rel="stylesheet" href="../../css/estilo.css" />
		<script src="../../javascript/jquery/jquery-1.8.2.min.js"></script>
		<script src="../../javascript/jquery/jquery-ui-1.8.20.custom.min.js"></script>
		<script src="../../javascript/jquery/jquery.validate.js"></script>
		<script src="../../javascript/jquery/validacao.js"></script>
		<script src="../../javascript/jquery/cadastraCandidato.js"></script>
		<script language="JavaScript" src="../../javascript/anticopia.js"></script>	
		<script type="text/javascript" src="../../javascript/consulta.js"></script>
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
			
				<?php include ("../../html/menuadmin.html"); ?>
				
			</div>
			
			<div id="conteudo">
				<h2>Cadastro de Disciplina</h2>
				<hr>
				<p />
				<form id="formulario" action="../gerenciadores/GerenciadorDisciplina.php" method="POST">
					<table id="cadastra">
						<tr>
							<td>Disciplina </td>
							<td><input type="text" name="disciplina" id="disciplina" class="required"></td>
						</tr>
					</table>
						<tr>
							<td></td>
							<td colspan="1"><input type="submit" name="Cadastrar"></td>	
							<td><input type="reset" name="Cancelar" value="Limpar Campos"></td>
						</tr>
					</table>
					<input type="hidden" name="acao" value="cadastrar">
				</form>
			</div>
			
				<div id="rodape">
			
				<?php include ("../../html/rodape.html");	?>			
				
			</div>
		</div>
	</body>
</html>
