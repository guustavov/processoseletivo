<html>
	<head>
	<title>Alteração</title>
	<link type="text/css" rel="stylesheet" href="../../css/estilo.css" />
	<script type="text/javascript" src="../../javascript/consulta.js"></script>
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
				<h2 align="left">Alterar Disciplina</h2>
				<hr>
				<form id="formulario" action="../gerenciadores/GerenciadorDisciplina.php" method="POST">
			
					<table>
						<?php
							foreach($vetDisci as $item){
								echo 
							"<tr>".
								"<td>Disciplina: </td>
								<td><input type='text' name='disciplina' value='".$item->getDisciplina()."'></td>".
							"</tr>".
							"<input type='hidden' name='codigo' value='".$item->getCodigo()."'>".
						"</table>";
							}
						?>
						<tr>
							<td><input type="submit" name="Atualizar"></td>
							<td><input type="reset" name="Cancelar" value="Restaurar Campo"></td>
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
