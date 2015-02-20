<html>
	<head>
		<title>Orientação</title>
		<link type="text/css" rel="stylesheet" href="../../css/estilo.css" />
		<link type="text/css" rel="stylesheet" href="../../css/estilojquery.css" />
		<script src="../../javascript/jquery/jquery-1.8.2.min.js"></script>
		<script src="../../javascript/jquery/jquery-ui-1.8.20.custom.min.js"></script>
		<script src="../../javascript/jquery/jquery.validate.js"></script>
	    <script language="JavaScript" src="../../javascript/jquery/formataData.js"></script>
	    <script src="../../javascript/jquery/validacaoGrupo.js"></script>
	    <script>
		$('document').ready(function(){
			$(".qntd").bind("change", menor);
			
			function menor(){
				var nome = $(this).attr("name");
				var resulta = nome.replace("qntd","");
				
				var spanId = $("#"+resulta).text();
				var valor = $(this).val();
				
				if(spanId < valor){
					alert("Não existem tantas questões.");
					 $(this).val('');
				}
			}
		});
	     </script> 
	     
	<script language="JavaScript" src="../../javascript/anticopia.js">
	</script>
	</head>
	<body onselectstart="return false">
		<div id="externa">
		
			<div id="cabecalho">			
				<?php 
				include("../login/protegePaginaOri.php"); 
				
				include ("../../html/cabecalho.html"); ?>
					

			</div>
			
			<?php 
					require_once ("../dao/DaoCandidato.php");
					$daoCand = new DaoCandidato;
					$vetCand = $daoCand->consultar();	
			?>
			
			<?php 
				require_once ("../dao/DaoDisciplina.php");
				$daoDisci = new DaoDisciplina;
				$vetDisci = $daoDisci->consultar();						
			?>
			
			<?php 
				require_once ("../dao/DaoCargo.php");
				$daoCarg = new DaoCargo;
				$vetCarg = $daoCarg->consultar();	
			?>
			
			<div id="menuLateral">
			
				<?php include ("../../html/menuori.html"); ?>
				
			</div>
			
			<div id="conteudo">
				<h2>Cadastro de Grupo</h2>
				<hr>
				<p />
				<form id="formulario" name="form1" action="../gerenciadores/GerenciadorGrupo.php" method="POST">
				<div id="1">
					<table id="cadastra">
						<tr>
							<td>Nome do Grupo:</td>
							<td> <select name="nome">
							<?php				
								require_once ("../dao/DaoGrupo.php");
								$daoGrupo = new DaoGrupo;
								foreach ($vetCarg as $item){
									$valor = $item->getCargo() . " " . date("Y");
									$cond = $daoGrupo->verificar($valor);
									if($cond == false){									
										echo  "<option value='". $valor . "'>" .$valor ."</option>";
									/*}/*else{									
										echo ("<OPTION SELECTED value=''>Grupos já existentes. Aguarde a criação de um novo grupo.");
										break;*/
									}
								}
								
							?>     
						</tr>
					</table>
				</div>
				
			<div id='2'>
				<hr>
				Selecione a data e hora da realização da prova: <span id="spanQuestao"><input type="text" name="data_realizacao" id="data" size='8' class='required'></span>
				<select name='hora'>
	
					<?php
						$cont = 0;
						while ($cont <= 23){
							echo "<option value='" .$cont . "'>";
							if($cont < 10) { echo "0".  $cont . "</option>";}else{ echo $cont . "</option>";}
							$cont++;
						}
						
					?>
				</select>
				:
				<select name='minutos'>
	
					<?php
						$cont = 0;
						while ($cont <= 59){
							echo "<option value='" .$cont . "'>";
							if($cont < 10) { echo "0".  $cont . "</option>";}else{ echo $cont . "</option>";}
							$cont++;
						}
						
					?>
				</select>
			</div>
			
			<div id='3'>
				Selecione a duração da prova: <span id="spanQuestao"><input type="text" name="duracao" id='duracao' size='3' maxlength='3' class="required digits"> (em minutos)</span>
			</div>


			<div id="4">
								<hr>
				<h3>Selecione a quantidade de questões:</h3>
				<table border="1">
						<th>
							Disciplina
						</th>
						<th>
							Fácil
						</th>
						<th>
							Médio
						</th>
						<th>
							Difícil
						</th>
					</tr>
							<?php
								$contTotal = 0;	
								foreach ($vetDisci as $item){
									echo 
										'<td>'.
											$item->getDisciplina() .
										'</td>'.
										'<td align="center">'.
											"<input type='text' id='qntdFacil' class='qntd' name='qntdFacil". $item->getCodigo(). "' size='2'>/<span id='Facil". $item->getCodigo(). "'>".$daoDisci->contaDisciplina($item->getDisciplina(), 'Fácil').
										'</span></td>'.
										'<td align="center">'.
											"<input type='text' class='qntd' name='qntdMedio". $item->getCodigo(). "' size='2'>/<span id='Medio". $item->getCodigo(). "'>".$daoDisci->contaDisciplina($item->getDisciplina(), 'Médio').
										'</span></td>'.
										'<td align="center">'.
											"<input type='text' class='qntd' name='qntdDificil". $item->getCodigo(). "' size='2'>/<span id='Dificil". $item->getCodigo(). "'>".$daoDisci->contaDisciplina($item->getDisciplina(), 'Difícil').
										'</span></td>'.
										'</tr><tr>';
										echo '<input type="hidden" name="disciplinas[]" value="'.  $item->getCodigo() .'" />';

										$contTotal++;
								} 

									echo '<input type="hidden" name="codigo" value="'. $contTotal .'">';
							
							?> 
					</tr>
				</table>
				<br>
				
				<?php
					if (!isset($vetDisci)){
						echo '<input type="submit" name="Cadastrar" disabled>';
					}else{
						echo '<input type="submit" name="Cadastrar">';
					}
				?>
				<input type="reset" name="Cancelar">
				
				<input type="hidden" name="acao" value="cadastrar">
					
				</form>
				</div>
				</div>
				
				<div id="rodape">
			
				<?php include ("../../html/rodape.html");	?>					
			</div>
		</div>
	</body>
</html>
