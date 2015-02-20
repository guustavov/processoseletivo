<html>
	<head>
	<title>Consulta por Filtro</title>
	<link type="text/css" rel="stylesheet" href="../../css/estilo.css" />
	<script src= "../../javascript/jquery/jquery-1.8.2.min.js" ></script>
	<script src="../../javascript/jquery/jquery-ui-1.8.20.custom.min.js"></script>
	<script src= "../../javascript/exclusaoCandidato.js" ></script>
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
			
				<?php include ("../../html/menuori.html"); ?>
				
			</div>
			
			<div id="conteudoResultado">					
					<?php
						if (isset($vetGrupo[0])){
							echo "<h4>Resultado da Pesquisa:</h4>
								<table class='consulta' width='70%'>
									<tr class='consulta'>
										<th>Codigo</th>
										<th>Nome</th>
										<th>Orientador</th>
									</tr>";
							foreach($vetGrupo as $item){
								echo "<tr>".
									"<td align='center'>".$item->getCodigo()."</td>".
									"<td align='center'><a href='../detalhes/infoGrupo.php?codigo=".$item->getCodigo()."'>".$item->getNome()."</a></td>".
									"<td align='center'>".$item->getOrientador_nome()."</td>".
									"</tr>";
							}
								echo "</table><br>";
						}else{
							echo "Nenhum grupo foi encontrado.";
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
