<html>
	<head>
	<title>Consulta Geral</title>
	<link type="text/css" rel="stylesheet" href="../../css/estilo.css" />
	<script src= "../../javascript/jquery/jquery-1.8.2.min.js" ></script>
	<script src="../../javascript/jquery/jquery-ui-1.8.20.custom.min.js"></script>

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
						if (isset($vetClassificacao[1][0])){
							echo '<h4>Resultado da Pesquisa:</h4>'.
								"<table class='consulta' width='500px'>
										<tr>
											<td></td>
											<th width='50%'> Grupo: </th>
											<td>".$vetClassificacao[1][0]."</td>"											 .
										"</tr>
										<tr>
											<th> </th>
											<th>Candidato</th>
											<th>Acertos</th>
										 </tr>";	
							$cont = 1;
							while($cont != null):	
								if (isset($vetClassificacao[$cont][0])){
									echo "<tr>
										 	<td align='center'>".$cont."º</td>
											<td align='center'>".$vetClassificacao[$cont][1]."</td>
											<td align='center'>".$vetClassificacao[$cont][2]."</td>
										</tr>";
								}else{
									break;
								}
								$cont++;
							endwhile;
						}else{
							echo "Esta prova ainda não foi realizada.";
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