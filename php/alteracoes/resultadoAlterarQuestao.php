<html>
	<head>
	<title>Alteração</title>
	<link type="text/css" rel="stylesheet" href="../../css/estilo.css" />
	<script src="../../javascript/jquery/jquery-1.8.2.min.js"></script>
	<script src="../../javascript/jquery/jquery-ui-1.8.20.custom.min.js"></script>
	<script src="../../javascript/jquery/jquery.validate.js"></script>
	<script src="../../javascript/jquery/validacao.js"></script>
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
				<h2 align="left">Alterar Questão</h2>
				<hr>
				<form id="formulario" action="../gerenciadores/GerenciadorQuestao.php" method="POST">
			
					<table>
						<?php
							foreach($vetQues as $item){
								echo "<tr>
										<td>Disciplina</td>
										<td>
											
								<select name='disciplina_codigo'>";
										
									    foreach ($vetDisci as $item2)
									       {
											if($item->getDisciplinaCodigo() == $item2->getCodigo()){
												echo "<option selected value=" .  $item2->getCodigo() ."> " . $item2->getDisciplina()."</option>";
											}else{
												echo "<option value=" .  $item2->getCodigo() ."> " . $item2->getDisciplina()."</option>";
											}
										} 
										
								echo "</select>

										</td>
									</tr>
								";
								
								if ($item->getNivel() == "Fácil"){
									echo 
										"<tr>
											<td>Nível da questão: </td>
											<td><input type='radio' name='nivelQ' value='Fácil' checked> <b>Fácil</b><br>
												<input type='radio' name='nivelQ' value='Médio' > Médio<br>
												<input type='radio' name='nivelQ' value='Difícil' > Díficil<br></td>
										</tr>";
								}else if ($item->getNivel() == "Médio"){
									echo 
										"<tr>
											<td>Nível da questão: </td>
											<td><input type='radio' name='nivelQ' value='Fácil' > Fácil<br>
												<input type='radio' name='nivelQ' value='Médio' checked > <b>Médio</b><br>
												<input type='radio' name='nivelQ' value='Difícil' > Díficil<br></td>
										</tr>";
								}else{
									echo 
										"<tr>
											<td>Nível da questão: </td>
											<td><input type='radio' name='nivelQ' value='Fácil' > Fácil<br>
												<input type='radio' name='nivelQ' value='Médio'  > Médio<br>
												<input type='radio' name='nivelQ' value='Difícil' checked><b> Díficil</b><br></td>
										</tr>";
								}
								
								echo
									"<tr>
										<td>Descrição </td>
										<td><textarea rows='12' cols='70' id='textareaD' name='descricaoQ'>
												". $item->getDescricao() ."
											</textarea>
										</td>
									</tr>
									<tr>
										<td>
											<span id='spanQuestao'>Marque a alternativa correta</span>
										</td>
									</tr>
									<tr>
										<td>";
											if($item->getGabarito() == "a"){
												echo "<input type='radio' name='alternativaCorreta' value='a' checked> <b>Alternativa A</b>";
											}else{
												echo "<input type='radio' name='alternativaCorreta' value='a'> Alternativa A";
											}
										echo "</td>
										<td><textarea rows='5' cols='70' id='textareaAA' name='a'>
											".$item->getA()."
											</textarea>
										</td>										
									</tr>
									<tr>
										<td>";
											if($item->getGabarito() == "b"){
												echo "<input type='radio' name='alternativaCorreta' value='b' checked> <b>Alternativa B</b>";
											}else{
												echo "<input type='radio' name='alternativaCorreta' value='b'> Alternativa B";
											}
										echo "</td>
										<td><textarea rows='5' cols='70' id='textareaAB' name='b'>
											".$item->getB()."
											</textarea>
										</td>										
									</tr>
									<tr>
										<td>";
											if($item->getGabarito() == "c"){
												echo "<input type='radio' name='alternativaCorreta' value='c' checked> <b>Alternativa C</b>";
											}else{
												echo "<input type='radio' name='alternativaCorreta' value='c'> Alternativa C";
											}
										echo "</td>
										<td><textarea rows='5' cols='70' id='textareaAC' name='c'>
											".$item->getC()."
											</textarea>
										</td>										
									</tr>
									<tr>
										<td>";
											if($item->getGabarito() == "d"){
												echo "<input type='radio' name='alternativaCorreta' value='d' checked> <b>Alternativa D</b>";
											}else{
												echo "<input type='radio' name='alternativaCorreta' value='d'> Alternativa D";
											}
										echo "</td>
										<td><textarea rows='5' cols='70' id='textareaAC' name='d'>
											".$item->getD()."
											</textarea>
										</td>										
									</tr>
									<input type='hidden' name='id' value='".$item->getCodigo()."'>";				
							}
						?>
						<tr>
							<td><input type="submit" name="Atualizar"></td>
							<input type="hidden" name="acao" value="atualizar">
							<td><input type="reset" name="Cancelar" value="Restaurar Campos"></td>
							
							
						</tr>
					</table>	
				</form>
				
			</div>
			<div id="rodape">
					
					<?php include ("../../html/rodape.html");	?>			
						
			</div>
		</div>
	</body>
</html>
