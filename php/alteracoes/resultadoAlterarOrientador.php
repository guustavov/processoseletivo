<html>
	<head>
	<title>Alteração</title>
	<link type="text/css" rel="stylesheet" href="../../css/estilo.css" />
	<script src="../../javascript/jquery/jquery-1.8.2.min.js"></script>
	<script src="../../javascript/jquery/jquery-ui-1.8.20.custom.min.js"></script>
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
	<body>
	
		<div id="externa">
			<div id="cabecalho">
				
				<?php include ("../../html/cabecalho.html"); ?>
				
			</div>	

			<div id="menuLateral">
			
				<?php include ("../../html/menuadmin.html"); ?>
				
			</div>
			
			<div id="conteudoResultado">	
				<h2 align="left">Alterar Orientador</h2>
				<hr>
				<form id="formulario" action="../gerenciadores/GerenciadorOrientador.php" method="POST">
			
					<table>
						<?php
							foreach($vetOri as $item){
								echo 
							"<tr>".
								"<td>Nome: </td>
								<td><span id='spanQuestao'><input type='text' name='nome' id='nome' value='".$item->getNome()."' class='required'></span></td>".
							"</tr>".
							"<tr>".
								"<td>RG: </td>
								<td><span id='spanQuestao'><input type='text' name='rg' id='rg' value='".$item->getRg()."' maxlength='10' class='required digits'></span></td>".
							"</tr>".
							"<tr>".
								"<td>Órgão Expeditor: </td>
								<td><span id='spanQuestao'><input type='text' name='expeditor' id='expeditor' value='".$item->getExpeditor()."'  onkeypress='return SemNumeros(event)' class='required' maxlength='6' size='5'>&nbsp;(Ex.: SSP/PR)</span></td>".
							"</tr>".
							"<tr>".
								"<td>CPF: </td>
								<td><span id='spanQuestao'><input type='text' name='cpf' id='cpf' value='".$item->getCpf()."' maxlength='11' class='required'><span class='alerta' id='invalido'>CPF inválido.</span></span></td>".
							"</tr>".
							"<tr>".
								"<td>Email: </td>
								<td><span id='spanQuestao'><input type='text' name='email' id='email' value='".$item->getEmail()."' class='required email'></span></td>".
							"</tr>".
							"<tr>".
								"<td>Senha: </td>
								<td><span id='spanQuestao'><input type='password' name='senha'  id='senha' value='".$item->getSenha()."' class='required'></span></td>".
							"</tr>".
							"<tr>".
								"<td>Confirmação de Senha: </td>
								<td><span id='spanQuestao'><input type='password' name='confSenha' value='".$item->getSenha()."' id='confSenha' class='required'></span></td>".
							"</tr>".
							"<input type='hidden' name='id' value='".$item->getCodigo()."'>";
							}
						?>
						<tr>
							<td><input type="submit" name="Atualizar" id="enviar"></td>
							<td><input type="reset" name="Cancelar" value="Restaurar Campos"></td>
							<input type="hidden" name="acao" value="atualizar">
							
						</tr>
					</table>	
				</form>
				
			</div>
			<div id="rodape">
					
					<?php include ("../../html/rodape.html");	?>			
						
			</div>
		</div>
	</body>
</html>
