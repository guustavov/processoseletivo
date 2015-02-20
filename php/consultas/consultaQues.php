<html>
	<head>
		<title>Administra��o</title>
		<link type="text/css" rel="stylesheet" href="../../css/estilo.css" />
		<script src= "../../javascript/jquery/jquery-1.8.2.min.js" ></script>
		<script src="../../javascript/jquery/jquery-ui-1.8.20.custom.min.js"></script>
		<script src="../../javascript/jquery/jquery.validate.js"></script>
		<script language="JavaScript" src="../../javascript/anticopia.js">
		</script>
		<script>
			$('document').ready(function(){
				$('#campo1').hide();
				$('#campo2').hide();
				$('#campo3').hide();
				
				$('#tipo').bind('click', tipo);
				$('#nivel').bind('click', nivel);
				$('#desc').bind('click', desc);
				function tipo(){
					$('#campo1').fadeIn();
					$('#campo2').fadeOut();
					$('#campo3').fadeOut();
				}
				function nivel(){
					$('#campo2').fadeIn();
					$('#campo1').fadeOut();
					$('#campo3').fadeOut();
				}
				function desc(){
					$('#campo3').fadeIn();
					$('#campo1').fadeOut();
					$('#campo2').fadeOut();
				}
				
				$('#enviar').attr('disabled', '');
				$('.valor').bind('change', liberaBotao);
				$('#campo3').bind('keypress', liberaBotao);
				$('#enviar').bind('click', verificaValor);
				
					function liberaBotao(){		
					var id = $(this).attr('id');
						if (($('#campo'+id).val()) != ""){
							$('#enviar').removeAttr('disabled');
						}else{
							$('#enviar').attr('disabled', '');
						}
					}
					
					
				function verificaValor(){
					var localidade = ($("input[type='radio']:checked").parent().next().children().attr("id"));
					if ($("#"+localidade+"").val() == ""){
						$('#enviar').attr('disabled', '');
					}else{
						$('#enviar').removeAttr('disabled');
					}
				}
			});
		</script>
	</head>
	<body onselectstart="return false">
		<div id="externa">
		
			<div id="cabecalho">
				<?php
					include("../login/protegePaginaAdmin.php"); 
				
					include ("../../html/cabecalho.html");
				?>

			</div>
			
			<div id="menuLateral">
				<?php
					include ("../../html/menuadmin.html");
				?>
				
			</div>
			
			<?php 
					require_once ("../dao/DaoDisciplina.php");
					$daoDisci = new DaoDisciplina;
					$vetDisci = $daoDisci->consultar();	
			?>
			
			<div id="conteudo">
				<h2>Consulta Quest�o</h2>
				<form action="../gerenciadores/GerenciadorQuestao.php" method="POST">
					
					<input class="consultaGeral" type="submit" value="Consulta Geral" />
					<input type="hidden" name="acao" value="consultar">
					<br>
					<br>
					<hr>
				</form>
				<form action="../gerenciadores/GerenciadorQuestao.php" method="POST">
						<table>
							<tr>
								<td rowspan=4>Consulta por: </td>
							</tr>
							<tr>
								<td>
									<input type="radio" name="tipo" id="tipo" value="disciplina_codigo"> Disciplina
								</td>
								<td>
								   <select name="campo1" id="campo1" class="valor">
									<option value="" selected>-</option>
									 <?php
										
									     foreach ($vetDisci as $item)
									       {
									    ?>
										    <option value="<?php echo $item->getCodigo(); ?>"><?php echo $item->getDisciplina()?></option>
									    <?php 									     } 
									    ?>     
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<input type="radio" name="tipo" id="nivel" value="nivel"> N�vel da Quest�o
								</td>
								<td>
									<select name="campo2" id="campo2"  class="valor">
										<option value="" selected>-</option>
										<option value="F�cil" >F�cil</option>
										<option value="M�dio">M�dio</option>
										<option value="Dif�cil">Dif�cil</option>
									</select>
								</td>
							<tr>
								<td>
									<input type="radio" name="tipo" id="desc" value="descricao"> Descri��o <span id="spanQuestao">(inteira ou parte dela)</span>
								</td>
								<td>
									<input type="text" name="campo3"  id="campo3" class="valor">
								</td>
							</tr>
							<tr>
								<td>
									<input class="consultaGeral" type="submit" value="Consulta por Filtro" id="enviar">
									<input type="hidden" name="acao" value="consultarFiltro">
								</td>
							</tr>
						</table>
					</form>
				</div>
			
				<div id="rodape">
				<?php
				include ("../../html/rodape.html");
				?>
	
			</div>
		</div>
	</body>
</html>
