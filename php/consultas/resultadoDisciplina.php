<html>
	<head>
	<title>Consulta Geral</title>
	<link type="text/css" rel="stylesheet" href="../../css/estilo.css" />
	<script src= "../../javascript/jquery/jquery-1.8.2.min.js" ></script>
	<script src="../../javascript/jquery/jquery-ui-1.8.20.custom.min.js"></script>
	<script src= "../../javascript/jquery/escondeEndereco.js" ></script>
	<script src= "../../javascript/exclusaoDisciplina.js" ></script>
	<script>
		$(document).ready(function(){
			$('.consulta tr:odd').addClass('par');
		});
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
					<?php
						if(isset($vetDisci[0])){
							echo "<h4>Resultado da Pesquisa:</h4>
								<table class='consulta' width='50%'>
									<tr class='consulta'>
									<th>Disciplina</th>
									</tr>";
							foreach($vetDisci as $item){						
								echo "<tr>".
									"<td align='center'>".$item->getDisciplina()."</td>".
									"<td align='center'><a href='../gerenciadores/GerenciadorDisciplina.php?acao=alterar&codigo=".$item->getCodigo()."'><img class='icons' src='../../imagens/icons/glyphicons_151_edit.png' title='editar'></a></td>";
							}
							echo	"</tr>";
						}else{
							echo 'Nenhuma questão foi encontrada.';
						}
						
					?>
					
				</table>
			</div>
			<div id="rodape">
				
				<?php include ("../../html/rodape.html");	?>			
					
			</div>
		</div>
	</body>
</html>