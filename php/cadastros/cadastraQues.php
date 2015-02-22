<html>
	<head>
		<title>Administra��o</title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />

		<link type="text/css" rel="stylesheet" href="../../css/estilo.css" />
		<link type="text/css" rel="stylesheet" href="../../css/estilo.css" />
		<link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    
   		<script src= "../../javascript/jquery/jquery-1.8.2.min.js" ></script>
		<script src="../../javascript/jquery/jquery-ui-1.8.20.custom.min.js"></script>
    	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
		<script src="../../javascript/jquery/jquery.validate.js"></script>
		<script type="text/javascript" src="../../javascript/jquery/textarea.js"></script>
		<script language="JavaScript" src="../../javascript/anticopia.js"></script>
		<script>
			$('document').ready(function(){	
				
				$('#formulario').submit(function(){		
					if ($('#textareaAA').val() == $('#textareaAB').val()){
						/*OR ($('#textareaAA').val() == $('#textareaAC').val()) 
						OR ($('#textareaAA').val() == $('#textareaAD').val()) OR ($('#textareaAB').val() == $('#textareaAC').val()) 
						OR ($('#textareaAB').val() == $('#textareaAD').val()) OR ($('#textareaAC').val() == $('#textareaAD').val()) 
						OR ($('#textareaAA').val() == 'Insira a 1� alternativa da quest�o...')
						OR ($('#textareaAB').val() == 'Insira a 2� alternativa da quest�o...')
						OR ($('#textareaAC').val() == 'Insira a 3� alternativa da quest�o...')
						OR ($('#textareaAD').val() == 'Insira a 4� alternativa da quest�o...'))*/
						alert ('oi');
						return false;
					}
				});
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

			<?php 
					require_once ("../dao/DaoDisciplina.php");
					$daoDisci = new DaoDisciplina;
					$vetDisci = $daoDisci->consultar();	
			?>
			
			<div>
				<div class="row">
					<div class="col-sm-3 col-md-3">
					
						<?php
							include ("../../html/menuadmin.html");
						?>
						
					</div>
					
					<div id="conteudo" class="col-sm-9 col-md-9" >

						<h2>Cadastro de Quest�o</h2>
						
						<form id='formulario' action="../gerenciadores/GerenciadorQuestao.php" method="POST">
							<table id="cadastra">
								<tr>
									<td>Disciplina</td>
									<td>
										   <select name="tipoQ">
											
											 <?php
												if($vetDisci == null){
													echo ("<OPTION SELECTED value=''>N�o h� disciplinas cadastrados");
													echo ("</select>&nbsp;&nbsp;&nbsp;<a href='cadastraDisci.php'><img class='icons' src='../../imagens/icons/glyphicons_152_new_window.png' title='cadastrar disciplina'></img></a></td>");
												}else{
											     foreach ($vetDisci as $item)
											       {
												    echo "<option value=" . $item->getCodigo() . ">" . $item->getDisciplina() . "</option>";
											    } }
											    ?>     
		    	                    </select>
									</td>							
								</tr>
								<hr>
								<tr class="divisao">
									<td>N�vel da quest�o: </td>
									<td><input type="radio" name="nivelQ" value="F�cil" checked> F�cil <span id='spanQuestao'>(quest�o de 1� Ano)</span> <br>
										<input type="radio" name="nivelQ" value="M�dio"> M�dio <span id='spanQuestao'>(quest�o de 2� Ano)</span><br>
										<input type="radio" name="nivelQ" value="Dif�cil"> Dif�cil <span id='spanQuestao'>(quest�o de 3� Ano)</span><br>
									</td>
								</tr>
								<tr>
									<td>Descri��o </td>
									<td><textarea rows="12" cols="70" id="textareaD" name="descricaoQ">
											Insira a descri��o da quest�o...
										</textarea>
									</td>
								</tr>
								<tr>
									<td>
										<span id='spanQuestao'>Marque a alternativa correta</span>
									</td>
								</tr>
								<tr>
									<td><input type="radio" name="alternativaCorreta" value="a" checked> Alternativa A</td>
									<td><textarea rows="5" cols="70" id="textareaAA" name="a">
											Insira a 1� alternativa da quest�o...
										</textarea>
									</td>
									<td>
									</td>
								</tr>
								<tr>
									<td><input type="radio" name="alternativaCorreta" value="b"> Alternativa B</td>
									<td><textarea rows="5" cols="70" id="textareaAB" name="b">
											Insira a 2� alternativa da quest�o...
										</textarea>
									</td>
									<td>
										
									</td>
								</tr>
								<tr>
									<td><input type="radio" name="alternativaCorreta" value="c"> Alternativa C</td>
									<td><textarea rows="5" cols="70" id="textareaAC" name="c">
											Insira a 3� alternativa da quest�o...
										</textarea>
									</td>
									<td>
										
									</td>
								</tr>
								<tr>
									<td><input type="radio" name="alternativaCorreta" value="d"> Alternativa D</td>
									<td><textarea rows="5" cols="70" id="textareaAD" name="d">
											Insira a 4� alternativa da quest�o...
										</textarea>
									</td>
									<td>
										
									</td>
								</tr>
								<tr>
									<td></td>
									<td align="center"><input type="submit" name="Cadastrar">
									<input type="reset" name="Cancelar" value="Limpar Campos"></td>
								</tr>
							</table>	
							<input type="hidden" name="acao" value="cadastrar">
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
