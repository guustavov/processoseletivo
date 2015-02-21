<html>
	<head>
		<title>Administra��o</title>
		<link type="text/css" rel="stylesheet" href="../../css/estilo.css" />
		<link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    
   		<script src= "../../javascript/jquery/jquery-1.8.2.min.js" ></script>
		<script src="../../javascript/jquery/jquery-ui-1.8.20.custom.min.js"></script>
    	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
		<script src="../../javascript/jquery/jquery.validate.js"></script>
		<script src="../../javascript/jquery/validacao.js"></script>
		<script src="../../javascript/validaCpf.js"></script>
		<script language="JavaScript" src="../../javascript/anticopia.js"></script>		
		<script language="JavaScript" src="../../javascript/limparCampos.js"></script>
		<script language="JavaScript">
			function SemNumeros(e){
			    var tecla=(window.event)?event.keyCode:e.which;   
			    if((tecla>64 && tecla<91) || (tecla>96 && tecla<123) || (tecla==47)) return true;
			    else{
				if (tecla==8 || tecla==0) return true;
				else  return false;
			    }
			}
		</script>
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
							<h2>Cadastro de Orientador</h2>
							<hr>
							<form id="formulario" name="formulario" action="../gerenciadores/GerenciadorOrientador.php" method="POST">
								<table id="cadastra">
									<tr>
										<td>Nome </td>
										<td><span id="spanQuestao"><input type="text" name="nome" id="nome" class="required"></span></td>
									</tr>
									<tr>
										<td>RG </td>
										<td><span id="spanQuestao"><input type="text" name="rg" id="rg" class="required digits" maxlength='10'></span></td>
									</tr>	
									<tr>
										<td>�rg�o Expeditor </td>
										<td><span id="spanQuestao"><input type="text" name="expeditor" id="expeditor" onkeypress='return SemNumeros(event)' class="required" maxlength='6' size='5'>&nbsp;(Ex.: SSP/PR)</span></td>
									</tr>
									<tr>
										<td>CPF </td>
										<td><span id="spanQuestao"><input type="text" name="cpf" id="cpf" maxlength='11' class='required'><span class="alerta" id="invalido">CPF inv�lido.</span></span></td>
									</tr>
									<tr>
										<td>Email </td>
										<td><span id="spanQuestao"><input type="text" name="email" id="email" class="required email"></span></td>
									</tr>
									<tr>
										<td>Senha </td>
										<td><span id="spanQuestao"><input type="password" name="senha" id="senha" class="required" maxlength='16'></span></td>
									</tr>
									<tr>
										<td>Confirma��o de Senha </td>
										<td><span id="spanQuestao"><input type="password" name="confSenha" id="confSenha" class="required" maxlength='16'></span></td>
									</tr>
									<tr>
										<td><input type="submit" name="Cadastrar" id="enviar"></td>
										<td><input type="button" name="Cancelar" value="Limpar Campos" onclick="javascript:confirmarLimpeza();"></span></td>
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
