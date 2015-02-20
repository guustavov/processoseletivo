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
	<script>
			$(document).ready(function(){
				var intervalo = setInterval(function() { 
					$('#tempo2').load("../detalhes/tempoProva.php"); 
					
					if($("#yes").attr("value") == "yes"){
						$("#hiddenCond").attr("value", "terminarProva");
						$("#enviar").click();
					}
				}, 1000);
			});
	</script>				
	
	</head>
	<body>	
		<div id="externa">
			<div id="cabecalho">
				
				<?php include ("../../html/cabecalho.html");
				
					include("../login/protegePaginaCand.php"); 

				?>
				
			</div>	
			
			<div id='tempo2'>
			
			</div>

		
			
			<div id="conteudoResultado">	
				<form action="../gerenciadores/GerenciadorGrupo.php" method="POST" name='envio'>	
				<div id="questoes">
					<?php
						$cont = 1;
						$cont2 = $cont + 4;
						$gab= '';
						while($cont <= $cont2):	
							if (isset($vetProvaQues[$cont][0])){
								if ($cont == 1){
									$primeiraQuestao = $vetProvaQues[$cont][2];
								}

								echo "<table class='consulta' width='90%'>
										<tr>
											<th class='show'>Questão: ".$vetProvaQues[$cont][2]."</th>
											<th class='show' width='80%'>Descrição </th>" .
										"<tr></tr><tr>".
											"<td align='center' class='tamanhoQuestao'>".
											$vetProvaQues[$cont][9] . " <br> ".
											"</td>".
											"<td width='80%' rowspan='2' colspan='5'>".$vetProvaQues[$cont][4].	"</td>".
										"</tr>".
										"<tr></tr>".
										
										"<tr><th><INPUT TYPE='radio' NAME='respostaCandidato".$vetProvaQues[$cont][0]."e".$vetProvaQues[$cont][2]."' VALUE='a'>A</th>".
												"<td>".$vetProvaQues[$cont][5]."</td>".
											"<tr><th><INPUT TYPE='radio' NAME='respostaCandidato".$vetProvaQues[$cont][0]."e".$vetProvaQues[$cont][2]."' VALUE='b'>B</th>".
												"<td>".$vetProvaQues[$cont][6]."</td>".
											"<tr><th><INPUT TYPE='radio' NAME='respostaCandidato".$vetProvaQues[$cont][0]."e".$vetProvaQues[$cont][2]."' VALUE='c'>C</th>".
												"<td>".$vetProvaQues[$cont][7]."</td>".
											"<tr><th><INPUT TYPE='radio' NAME='respostaCandidato".$vetProvaQues[$cont][0]."e".$vetProvaQues[$cont][2]."' VALUE='d'>D</th>".
												"<td>".$vetProvaQues[$cont][8]."</td></tr></table>".
										"<BR>";
										$gab = $gab . $vetProvaQues[$cont][10];
										
							}else{
								break;
							}
							$cont++;
						endwhile;
						
						$ultimaQuestao = $vetProvaQues[$cont-1][2];
						
						if (isset($vetProvaQues[$cont][0])){
							echo "<input type='submit' name='proximasQuestoes'  id='enviar' value='Próximas Questões'>";
							echo "<input type='hidden' name='acao' id='hiddenCond' value='continuarProva'>";
							echo "<input type='hidden' name='proximaQuestao' value=".$cont.">";							
							echo "<input type='hidden' name='primeiraQuestao' value=".$primeiraQuestao.">";
							echo "<input type='hidden' name='ultimaQuestao' value=".$ultimaQuestao.">";
							echo "<input type='hidden' name='codigoProva' value=".$vetProvaQues[1][0].">";
							echo "<input type='hidden' name='gab' value=".$gab.">";
							
						}else{
							echo "<input type='submit' name='proximasQuestoes' id='enviar' value='Terminar Prova'>";
							echo "<input type='hidden' name='acao' value='terminarProva'>";
							echo "<input type='hidden' name='primeiraQuestao' value=".$primeiraQuestao.">";
							echo "<input type='hidden' name='ultimaQuestao' value=".$ultimaQuestao.">";
							echo "<input type='hidden' name='codigoProva' value=".$vetProvaQues[1][0].">";
							echo "<input type='hidden' name='gab' value=".$gab.">";
						}
					
					?>
				</div>
				</form>	
			</div>

			
			<div id="rodape">
				
				<?php include ("../../html/rodape.html");	?>			
					
			</div>
		</div>
	</body>
</html>