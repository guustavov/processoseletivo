<html>
	<head>
	<title>Consulta Geral</title>
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

			<?php
				require_once("../dao/DaoCandidato.php");
				$daoCandidato = new DaoCandidato;
				$vetCand = $daoCandidato->consultarCodigo($_GET["codigo"]);
			?>

			<div id="menuLateral">
			
				<?php 
					if(isset($_GET["a"])){
						include ("../../html/menuori.html");
					}else{
						include ("../../html/menuadmin.html");
					}
				?>
				
			</div>
			
			<div id="conteudoResultado">			
				<p class="titulo">Informações Gerais</p>
				<table class="consulta" width="500" >
					<?php
					foreach($vetCand as $item){	
					
						if(isset($_GET["a"])){
								echo "<tr>".
									"<td width='200px' align='center' colspan='2'><span class='nome'>".$item->getNome()."</span></td>".
									"</tr>";
						}else{
								echo "<tr>".
									"<td></td><td width='200px' align='center' colspan='2'><span class='nome'>".$item->getNome()."</span></td>".
									"<td align='right'><a href=\"javascript:confirmarExclusao('".$item->getNome()."'," .$item->getCodigo().
									")\"><img class='icons' src='../../imagens/icons/glyphicons_016_bin.png' title='excluir'></a>&nbsp;&nbsp;&nbsp;".
									"<a href='../gerenciadores/GerenciadorCandidato.php?acao=alterar&codigo=".$item->getCodigo()."'><img class='icons' src='../../imagens/icons/glyphicons_151_edit.png' title='editar'></a></td>".
									"</tr>";
						}
							echo "<tr><th>RG</th><td colspan='3'>".$item->getRg()." (".$item->getExpeditor().")</td></tr>".
									"<tr><th>CPF</th><td colspan='3'>".$item->getCpf()."</td></tr>".
									"<tr><th>Nascimento</th><td colspan='3'>".$item->getData_nascimento()."</td></tr>".
									"<tr><th>Email</th><td colspan='3'>".$item->getEmail()."</td></tr>".
									"<tr><th>Cargo</th><td colspan='3'>".$item->getCargo()."</td></tr>".
									"<tr><th>Escolaridade</th><td colspan='3'>".$item->getEscolaridade()."</td></tr>".
									"<tr><th>Telefone</th><td colspan='3'>".$item->getTelefone()."</td></tr>".
							

									"</tr><tr>".
											"<th>Endereço:</th>".
											"<td colspan='3'>".$item->getRua().", ".
											$item->getNumero().", ".
											$item->getBairro().", ".
											"".$item->getComplemento().", ".
											$item->getCidade().
											" (".$item->getEstado()."). &nbsp;&nbsp;".
											
											" <b>CEP:</b> ".$item->getCep()."</td>";
						}
						echo	"</tr>";
					?>
					
				</table><br><br>
				<?php 
					if(!isset($_GET["a"])){
						echo ('<a href="../gerenciadores/GerenciadorCandidato.php?acao=consultar"><img class="icons" src="../../imagens/icons/glyphicons_221_unshare.png"></a>');
					}else{
						echo  ('<a href="../detalhes/infoGrupo.php"><img class="icons" src="../../imagens/icons/glyphicons_221_unshare.png"></a>');
					}
				?>
				</div>
			<div id="rodape">
				
				<?php include ("../../html/rodape.html");	?>			
					
			</div>
		</div>
	</body>
</html>
