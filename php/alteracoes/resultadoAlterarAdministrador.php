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
				<h2 align="left">Alterar Dados</h2>
				<hr>
				<form id="formulario" action="../gerenciadores/GerenciadorAdministrador.php" method="POST">
			
					<table>
						<?php
							foreach($vetAdm as $item){
								echo 
							"<tr>".
								"<td>Nome: </td>
								<td><span id='spanQuestao'><input type='text' name='nome' id='nome' value='".$item->getNome()."' class='required'></span></td>".
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
