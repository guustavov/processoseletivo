<html>
	<head>
		<title>Administração</title>
		<link type="text/css" rel="stylesheet" href="../../css/estilo.css" />
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
						
			<div id="conteudoLogin">
				<div id="login">
					<form action="../gerenciadores/GerenciadorLogin.php" method="POST">
					<table>
						<tr>
							<td>Login:</td>
							<td><input type="text" id="usuario" class="usuario" name="usuario"></td>
						</tr>
						<tr>
							<td>Senha:</td>
							<td><input type="password" id="senha" class="senha" name="senha"></td>
						</tr>
						<tr>
							<td colspan="2" align="center">
								<input type="submit" value="entrar" class="botaoLogin">
								<input type="hidden" name="acao" value="login">
							</td>
						</tr>
					</table>
					</form>
				</div>
			</div>
			
			<div id="rodape">
				<?php include ("../../html/rodape.html");	?>
			</div>
		</div>
	</body>
</html>
