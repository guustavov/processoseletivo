<html>
	<head>
		<title>Orientação</title>
		<link type="text/css" rel="stylesheet" href="../../css/estilo.css" />
		<script src= "../../javascript/jquery/jquery-1.8.2.min.js" ></script>
		<script src="../../javascript/jquery/jquery-ui-1.8.20.custom.min.js"></script>
		<script src="../../javascript/jquery/jquery.validate.js"></script>
		<script language="JavaScript" src="../../javascript/anticopia.js"></script>
		<script>
			$('document').ready(function(){
				//campos de pesquisa
				$('input:text').hide();				
				$('input:radio').bind('click', tipo);
				
				function tipo(){
					var id = $(this).attr('id');					
					$('input:text').fadeOut();
					$('input:text').val('');
					$('#campo'+id).fadeIn('slow');
					$('#campo'+id).attr('name','campo');					
					
				}				
				//botao enviar
				$('#enviar').attr('disabled', '');
				$('.valor').bind('change', liberaBotao);
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
		<script language='JavaScript'>
			function SomenteNumero(e){
			    var tecla=(window.event)?event.keyCode:e.which;   
			    if((tecla>47 && tecla<58)) return true;
			    else{
				if (tecla==8 || tecla==0) return true;
				else  return false;
			    }
			}
		</script>
	</head>
	<body onselectstart="return false">
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
						<h2>Consulta Grupo</h2>
						<form action="../gerenciadores/GerenciadorGrupo.php" method="POST">
							
							<input class="consultaGeral" type="submit" value="Consulta Geral" />
							<input type="hidden" name="acao" value="consultar">
							<hr>
						</form>
							<form action="../gerenciadores/GerenciadorGrupo.php" method="POST">
								<table>
									<tr>
										<td rowspan=4>Consulta por: </td>
									</tr>
									<tr>
										<td>
											<input type="radio" name="tipo" id="1" value="g.nome"> Cargo 
										</td>
										<td>
											<input type="text" name="" id="campo1" class="valor">
										</td>
									</tr>
									<tr>
										<td>
											<input type="radio" name="tipo" id="2" value="g.nome"> Ano
										</td>
										<td>
											<input type="text" name="" id="campo2" onkeypress='return SomenteNumero(event)' maxlength='4' class="valor">
										</td>
									</tr>
									<tr>
										<td>
											<input type="radio" name="tipo" id="3" value="o.nome" > Orientador
										</td>
										<td>
											<input type="text" name="" id="campo3" class="valor">
										</td>
									</tr>
									<tr>
										<td>
											<input class="consultaGeral" type="submit" value="Consulta por Filtro" id="enviar"/>
											<input type="hidden" name="acao" value="consultarFiltro">
										</td>
									</tr>
								</table>
							</form>
						</div>
					</div>
				</div>
				<div id="rodape">
					<?php
						include ("../../html/rodape.html");				
					?>
			</div>
		</div>
	</body>
</html>
