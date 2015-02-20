<html>
	<head>
	<title>Consulta Geral</title>
	<link type="text/css" rel="stylesheet" href="../../css/estilo.css" />
	<script src= "../../javascript/jquery/jquery-1.8.2.min.js" ></script>
	<script src="../../javascript/jquery/jquery-ui-1.8.20.custom.min.js"></script>
	<script src= "../../javascript/jquery/escondeEndereco.js" ></script>
	<script src= "../../javascript/exclusaoCandidato.js" ></script>
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
				<table class="consulta" width="70%">
				<tr align="center">
					<th colspan='2'> <? echo $vetCandGrupo[0]->getNome_grupo() ?></th>
				</tr>
				<tr >
					<th align="right">Candidatos:</th><td>&nbsp;</td>
				</tr>
					<?php
						foreach($vetCandGrupo as $item){						
							echo ("<tr>".
								"<td></td><td><a href='../detalhes/infoCandidato.php?codigo=".$item->getCandidato_codigo()."&a=false'>".$item->getNome_candidato()."</a></td>"

);
						}
						echo	"</tr>";
						
					?>
					
				</table>
			</div>
			<div id="rodape">
				
				<?php include ("../../html/rodape.html");	?>			
					
			</div>
		</div>
	</body>
</html>