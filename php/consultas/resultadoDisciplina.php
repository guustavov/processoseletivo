<html>
	<head>
	<title>Consulta Geral</title>
	<link type="text/css" rel="stylesheet" href="../../css/estilo.css" />
	<link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    
	<script src= "../../javascript/jquery/jquery-1.8.2.min.js" ></script>
	<script src="../../javascript/jquery/jquery-ui-1.8.20.custom.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
	
	<script src= "../../javascript/jquery/escondeEndereco.js" ></script>
	<script src= "../../javascript/exclusaoDisciplina.js" ></script>
	<script>
		$(document).ready(function(){
			$('.consulta tr:odd').addClass('par');
		});
	</script>
	</head>
	<body>	
		<div class="container">
			
			<div id="cabecalho">
				<?php
					include ("../login/protegePaginaAdmin.php");
					
					include ("../../html/cabecalho.html");
				?>
			</div>
					
			<div>
				<div class="row">
					<div class="col-sm-3 col-md-3">
					
						<?php
							include ("../../html/menuadmin.html");
						?>
						
					</div>
					
					<div id="conteudo" class="col-sm-9 col-md-9">
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
				</div>
			</div>
			<div id="rodape">
				
				<?php include ("../../html/rodape.html");	?>			
					
			</div>
		</div>
	</body>
</html>