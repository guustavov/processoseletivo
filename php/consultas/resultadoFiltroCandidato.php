          <html>
	<head>
	<title>Consulta por Filtro</title>
	<link type="text/css" rel="stylesheet" href="../../css/estilo.css" />
	<script src= "../../javascript/jquery/jquery-1.8.2.min.js" ></script>
	<script src="../../javascript/jquery/jquery-ui-1.8.20.custom.min.js"></script>
	<script src= "../../javascript/jquery/escondeEndereco.js" ></script> 
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
			
				<?php include ("../../html/menuadmin.html"); ?>
				
			</div>
			
			<div id="conteudoResultado">
					<?php
						if(isset($vetCand[0])){
							echo '<h4>Resultado da Pesquisa:</h4>
								<table class="consulta" width="500">
								<tr class="consulta">
									<th>Nome</th>
									<th>Cargo</th>
								</tr>';
							foreach($vetCand as $item){						
								echo "<tr align='center'>".
									"<td><a href='../detalhes/infoCandidato.php?codigo=".$item->getCodigo()."'>".$item->getNome()."</a></td>".
									"<td>".$item->getCargo()."</td>".
									"<td><a href=\"javascript:confirmarExclusao('".$item->getNome()."'," .$item->getCodigo().
									")\"><img class='icons' src='../../imagens/icons/glyphicons_016_bin.png' title='excluir'></a></td>".
									"<td><a href='../gerenciadores/GerenciadorCandidato.php?acao=alterar&codigo=".$item->getCodigo()."'><img class='icons' src='../../imagens/icons/glyphicons_151_edit.png' title='editar'></a></td>";
							}
						}else{
							echo ('Nenhum candidato foi encontrado.');
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
