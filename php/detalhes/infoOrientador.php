<html>
	<head>
	<title>Consulta Geral</title>
	<link type="text/css" rel="stylesheet" href="../../css/estilo.css" />
	<script src= "../../javascript/jquery/jquery-1.8.2.min.js" ></script>
	<script src="../../javascript/jquery/jquery-ui-1.8.20.custom.min.js"></script>
	<script src= "../../javascript/exclusaoOrientador.js" ></script>
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

			<?php
				require_once("../dao/DaoOrientador.php");
				$daoOrientador = new DaoOrientador;
				$vetOri = $daoOrientador->consultarCodigo($_GET["codigo"]);
			?>

			<div id="menuLateral">
			
				<?php include ("../../html/menuadmin.html"); ?>
				
			</div>
			
			<div id="conteudoResultado">			
				<p class="titulo">Informações Gerais</p>
				<table class="consulta" width="500" >
					<?php
						foreach($vetOri as $item){						
							echo "<tr>".
								"<td> </td><td width='200px' align='center' colspan='2'><span class='nome'>".$item->getNome()."</span></td>".
								"<td align='right'><a href=\"javascript:confirmarExclusao('".$item->getNome()."'," .$item->getCodigo().
									")\"><img class='icons' src='../../imagens/icons/glyphicons_016_bin.png' title='excluir'></a>   ".
								"<a href='../gerenciadores/GerenciadorOrientador.php?acao=alterar&codigo=".$item->getCodigo()."'><img class='icons' src='../../imagens/icons/glyphicons_151_edit.png' title='editar'></a></td>".
								"</tr>".
								"<tr><th>RG</th><td  colspan='3'>".$item->getRg()." (".$item->getExpeditor().")</td></tr>".
								"<tr><th>CPF</th><td colspan='3'>".$item->getCpf()."</td></tr>".
								"<tr><th>Email</th><td colspan='3'>".$item->getEmail()."</td></tr>";
						}
						echo	"</tr>";
						
					?>
					
				</table><br><br>
				<a href="../gerenciadores/GerenciadorOrientador.php?acao=consultar"><img class="icons" src="../../imagens/icons/glyphicons_221_unshare.png"></a>
			</div>
			<div id="rodape">
				
				<?php include ("../../html/rodape.html");	?>			
					
			</div>
		</div>
	</body>
</html>
