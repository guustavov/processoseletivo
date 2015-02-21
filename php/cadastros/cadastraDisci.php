<html>
	<head>
		<title>Administração</title>
		<link type="text/css" rel="stylesheet" href="../../css/estilo.css" />
		<link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    
   		<script src= "../../javascript/jquery/jquery-1.8.2.min.js" ></script>
		<script src="../../javascript/jquery/jquery-ui-1.8.20.custom.min.js"></script>
    	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
		
		<script src="../../javascript/jquery/jquery.validate.js"></script>
		<script src="../../javascript/jquery/validacao.js"></script>
		<script src="../../javascript/jquery/cadastraCandidato.js"></script>
		<script language="JavaScript" src="../../javascript/anticopia.js"></script>	
		<script type="text/javascript" src="../../javascript/consulta.js"></script>
	</head>
	<body onselectstart="return false">
		<div class="container">
			
			<div id="cabecalho">
				<div class="row">
					<div class="col-sm-12 col-md-12">
						<?php
							include ("../login/protegePaginaAdmin.php");
							
							include ("../../html/cabecalho.html");
						?>
					</div>
				</div>
			</div>

				<div>
				<div class="row">
					<div class="col-sm-3 col-md-3">
					
						<?php
							include ("../../html/menuadmin.html");
						?>
						
					</div>
					
					<div id="conteudo" class="col-sm-9 col-md-9">
						<h2>Cadastro de Disciplina</h2>
						<hr>
						
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
				</div>
			</div>
			
			<div id="rodape"> 
				<div class="row">
					<div class="col-sm-3 col-md-12">
						<div class="panel panel-default">
							<div class="panel-heading">haha</div>
							<div class="panel-body">
								<?php
									include ("../../html/rodape.html");				
								?>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
