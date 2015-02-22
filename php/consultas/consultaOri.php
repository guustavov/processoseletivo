<html>
	<head>
		<title>Administração</title>
		<link type="text/css" rel="stylesheet" href="../../css/estilo.css" />
		<link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    
   		<script src= "../../javascript/jquery/jquery-1.8.2.min.js" ></script>
		<script src="../../javascript/jquery/jquery-ui-1.8.20.custom.min.js"></script>
    	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
		<script src="../../javascript/jquery/jquery.validate.js"></script>
		<script language="JavaScript" src="../../javascript/anticopia.js">
		</script>
		<script>
		
			$('document').ready(function(){
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
				$('.valor').bind('keypress', liberaBotao);
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
						<h2>Consulta Orientador</h2>
						<form action="../gerenciadores/GerenciadorOrientador.php" method="POST">
							
							<input class="consultaGeral" type="submit" value="Consulta Geral" />
							<input type="hidden" name="acao" value="consultar">
							<br>
							<br>
							<hr>
						</form>
						<form action="../gerenciadores/GerenciadorOrientador.php" method="POST">
								<table>
									<tr>
										<td rowspan=5>Consulta por: </td>
									</tr>
									<tr>
										<td>
											<input type="radio" name="tipo" id="1" value="nome"> Nome
										</td>
										<td>
											<input type="text" name="" id="campo1" class="valor">
										</td>
									</tr>
									<tr>
										<td>
											<input type="radio" name="tipo" id="2" value="rg" > RG
										</td>
										<td>
											<input type="text" name="" id="campo2" maxlength='10' onkeypress='return SomenteNumero(event)' class="valor">
										</td>
									</tr>
									<tr>
										<td>
											<input type="radio" name="tipo" id="3" value="cpf" onkeypress='return SomenteNumero(event)'> CPF
										</td>
										<td>
											<input type="text" name="" id="campo3"  maxlength="11" class="valor">
										</td>
									</tr>
									<tr>
										<td>
											<input type="radio" name="tipo" id="4" value="email" > Email
										</td>
										<td>
											<input type="text" name="" id="campo4" class="valor">
										</td>
									</tr>
									<tr>
										<td>
											<span id='spanCandidato'>(RG e CPF são números, utilize apenas números).</span>
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
