<html>
	<head>
	<title>Consulta Geral</title>
	<link type="text/css" rel="stylesheet" href="../../css/estilo.css" />
	<script src= "../../javascript/jquery/jquery-1.8.2.min.js" ></script>
	<script src="../../javascript/jquery/jquery-ui-1.8.20.custom.min.js"></script>
	<script src= "../../javascript/jquery/escondeQuestao.js" ></script>
	<script src= "../../javascript/exclusaoQuestao.js" ></script>
	</head>
	<body>	
		<div id="externa">
			<div id="cabecalho">
				
				<?php include ("../../html/cabecalho.html"); ?>
				
			</div>	
			
			<?php 
					require_once ("../dao/DaoDisciplina.php");
					$daoDisci = new DaoDisciplina;
					$vetDisci = $daoDisci->consultar();	
				?>

			<div id="menuLateral">
			
				<?php include ("../../html/menuadmin.html"); ?>
				
			</div>
			
			<div id="conteudoResultado">			
					<?php
						if(isset($vetQues[0])){
							echo	"<h4>Resultado da Pesquisa:</h4>";
							foreach($vetQues as $item){
								$codigoItem = $item->getCodigo();
								echo ("<table class='consultaQuestao' width='750'>
										<tr class='consulta'>
											<th class='show'>Código: ".$codigoItem."</th>
											<th class='show' width='80%'>Descrição </th>" .
											"<td align='center'><img class='mais' id='".$codigoItem."' src='../../imagens/icons/glyphicons_190_circle_plus.png' title='mais resultados'></td>".
											"<td align='center'><a href=\"javascript:confirmarExclusao(".$codigoItem.
												")\"><img class='icons' src='../../imagens/icons/glyphicons_016_bin.png' title='excluir'></a></td>".
											"<td align='center'><a href='../gerenciadores/GerenciadorQuestao.php?acao=alterar&codigo=".$codigoItem."'><img class='icons' src='../../imagens/icons/glyphicons_151_edit.png' title='editar'></img></a></td>".
										"<tr></tr>".
											"<td align='center' class='tamanhoQuestao'>");
											
											
											   foreach ($vetDisci as $item2)
												{
												if($item->getDisciplinaCodigo() == $item2->getCodigo()){
													echo $item2->getDisciplina() . " <br> " . $item->getNivel() ;
												}
											} 
											
											echo("</td>".
											"<td width='80%' rowspan='2' colspan='5'>".$item->getDescricao()."</td>".
										"</tr>".
										"<tr></tr>");

										if($item->getGabarito() == "A"){

											echo ("<tr><th class='th".$codigoItem."'><span id='resposta'>A</span></th>".
													"<td class='hide' id='A".$codigoItem."'>".$item->getA()."</td>".
												"<tr><th class='th".$codigoItem."'>B</th>".
													"<td class='hide' id='B".$codigoItem."'>".$item->getB()."</td>".
												"<tr><th class='th".$codigoItem."'>C</th>".
													"<td class='hide' id='C".$codigoItem."'>".$item->getC()."</td>".
												"<tr><th class='th".$codigoItem."'>D</th>".
													"<td class='hide' id='D".$codigoItem."'>".$item->getD()."</td></tr>");

										}else
										if($item->getGabarito() == "B"){

											echo ("<tr><th class='th".$codigoItem."'>A</th>".
													"<td class='hide' id='A".$codigoItem."'>".$item->getA()."</td>".
												"<tr><th class='th".$codigoItem."'><span id='resposta'>B</span></th>".
													"<td class='hide' id='B".$codigoItem."'>".$item->getB()."</td>".
												"<tr><th class='th".$codigoItem."'>C</th>".
													"<td class='hide' id='C".$codigoItem."'>".$item->getC()."</td>".
												"<tr><th class='th".$codigoItem."'>D</th>".
													"<td class='hide' id='D".$codigoItem."'>".$item->getD()."</td></tr>");

										}else
										if($item->getGabarito() == "C"){

											echo ("<tr><th class='th".$codigoItem."'>A</th>".
													"<td class='hide' id='A".$codigoItem."'>".$item->getA()."</td>".
												"<tr><th class='th".$codigoItem."'>B</th>".
													"<td class='hide' id='B".$codigoItem."'>".$item->getB()."</td>".
												"<tr><th class='th".$codigoItem."'><span id='resposta'>C</span></th>".
													"<td class='hide' id='C".$codigoItem."'></img>".$item->getC()."</td>".
												"<tr><th class='th".$codigoItem."'>D</th>".
													"<td class='hide' id='D".$codigoItem."'>".$item->getD()."</td></tr>");

										}else
										if($item->getGabarito() == "D"){

											echo ("<tr><th class='th".$codigoItem."'>A</th>".
													"<td class='hide' id='A".$codigoItem."'>".$item->getA()."</td>".
												"<tr><th class='th".$codigoItem."'>B</th>".
													"<td class='hide' id='B".$codigoItem."'>".$item->getB()."</td>".
												"<tr><th class='th".$codigoItem."'>C</th>".
													"<td class='hide' id='C".$codigoItem."'>".$item->getC()."</td>".
												"<tr><th class='th".$codigoItem."'><span id='resposta'>D</span></th>".
													"<td class='hide' id='D".$codigoItem."'>".$item->getD()."</td></tr>");

										}
									echo ("</table>");
								echo("<br>");
							}
							
						}else{
							echo('Nenhuma questão foi encontrada.');
						}
	
	
	
					?>

			</div>
			<div id="rodape">
				
				<?php include ("../../html/rodape.html");	?>			
					
			</div>
		</div>
	</body>
</html>