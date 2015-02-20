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
				require_once("../dao/DaoGrupo.php");
				
				require_once("../dao/DaoCandidatoGrupo.php");
				$daoGrupo = new DaoGrupo;
				
				if (!isset($_GET["codigo"])){
					$_GET["codigo"] = $daoGrupo->contarGrupo();
				}
				
				$vetGrupo = $daoGrupo->consultarCodigo($_GET["codigo"]);
				
				$daoCandGrupo = new DaoCandidatoGrupo;
				$valor = $daoCandGrupo->contarGrupoCodigo($_GET["codigo"]);
			?>

			<div id="menuLateral">
			
				<?php include ("../../html/menuori.html"); ?>
				
			</div>
			
			<div id="conteudoResultado">			
				<p class="titulo">Informações Gerais</p>
				<table class="consulta" width="500" >
				
				<?php	

				echo	 ("<tr><td width='200px' align='center' colspan='2'><span class='nome'>".$vetGrupo[1][1]."</span></td></tr>".
							"<tr><th width='40%'>Orientador Responsável:</th><td>".$vetGrupo[1][2]."</td></tr>".
							"<tr><th>Data da criação:</td><td>".$vetGrupo[1][3]."</td></tr>".
							"<tr><th>Data da realização:</td><td>".$vetGrupo[1][6]." às ". $vetGrupo[1][7]."</td></tr>".
							"<tr><th colspan='2' align='center'>Candidatos:</th></tr>");
						$cont = 1;
							while ($cont <= $valor){						
								echo "<tr><td colspan='2' align='center'><a href='../detalhes/infoCandidato.php?codigo=".$vetGrupo[$cont][5]."&a=false'>".$vetGrupo[$cont][4]."</a></td>";
							$cont++;
						}
						
					?>
					
				</table><br>
				<a href="../gerenciadores/GerenciadorGrupo.php?acao=consultar"><img class="icons" src="../../imagens/icons/glyphicons_221_unshare.png"></a>
			</div>
			<div id="rodape">
				
				<?php include ("../../html/rodape.html");	?>			
					
			</div>
		</div>
	</body>
</html>
