<html>
	<head>
		<title>Administração</title>
		<link type="text/css" rel="stylesheet" href="../../css/estilo.css" />
		<link type="text/css" rel="stylesheet" href="../../css/estilojquery.css" />
		<script src="../../javascript/jquery/jquery-1.8.2.min.js"></script>
		<script src="../../javascript/jquery/jquery-ui-1.8.20.custom.min.js"></script>
		<script src="../../javascript/jquery/jquery.validate.js"></script>
		<script src="../../javascript/jquery/validacao.js"></script>
		<script src="../../javascript/jquery/mostraEndereco.js"></script>
		<script src="../../javascript/validaCpf.js"></script>
		<script language="JavaScript" src="../../javascript/anticopia.js"></script>	
		<script language="JavaScript" src="../../javascript/consultaCep.js"></script>
		<script language="JavaScript" src="../../javascript/limparCampos.js"></script>
		<script language="JavaScript" src="../../javascript/jquery/formataData.js"></script>
		<script language="JavaScript">
			function SemNumeros(e){
			    var tecla=(window.event)?event.keyCode:e.which;   
			    if((tecla>64 && tecla<91) || (tecla>96 && tecla<123) || (tecla==47)) return true;
			    else{
				if (tecla==8 || tecla==0) return true;
				else  return false;
			    }
			}
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
			
			<?php 
					require_once ("../dao/DaoCargo.php");
					$daoCarg = new DaoCargo;
					$vetCarg = $daoCarg->consultar();	
			?>
			
			<div id="menuLateral">
			
				<?php include ("../../html/menuadmin.html"); ?>
				
			</div>
			
			<div id="conteudo">
				<h2>Cadastro de Candidato</h2>
				<hr>
				<p />
				<form id="formulario" action="../gerenciadores/GerenciadorCandidato.php" method="POST">
					<table id="cadastra">
						<tr>
							<td>Nome </td>
							<td><span id="spanQuestao"><input type="text" name="nome" id="nome" class="required"></span></td>
						</tr>
						<tr>
							<td>RG </td>
							<td><span id="spanQuestao"><input type="text" name="rg" id="rg" class="required digits" maxlength='10'></span></td>
						</tr>
						<tr>
							<td>Órgão Expeditor</td>
							<td><span id="spanQuestao"><input type="text" name="expeditor" id="expeditor" onkeypress='return SemNumeros(event)' class="required" maxlength='6' size='5'>&nbsp;(Ex.: SSP/PR)</span></td>
						</tr>
						<tr>
							<td>CPF </td>
							<td><span id="spanQuestao"><input type="text" name="cpf" id="cpf" maxlength='11' class='required'><span class="alerta" id="invalido">CPF inválido.</span></span></td>
						</tr>
						<tr>
							<td>Data de Nascimento </td>
							<td><span id="spanQuestao"><input type="text" name="data_nascimento" id="data" maxlength='10' class='required'></span></td>
						</tr>
						<tr>
							<td>Telefone </td>
							<td><span id="spanQuestao"><input type="text" name="telefone" id="telefone" class="required digits"></span></td>
						</tr>
						<tr>
							<td>Email </td>
							<td><span id="spanQuestao"><input type="text" name="email" id="email" class="required email"></span></td>
						</tr>
						<tr>
							<td>Senha </td>
							<td><span id="spanQuestao"><input type="password" name="senha" id="senha" class="required" maxlength='16'></span></td>
						</tr>
						<tr>
							<td>Confirmação de Senha </td>
							<td><span id="spanQuestao"><input type="password" name="confSenha" id="confSenha" class="required" maxlength='16'></span></td>
						</tr>
						<tr>
							<td>Cargo a concorrer</td>
							<td><select name="cargo">
									 <?php
									if($vetCarg == null){
										echo ("<OPTION SELECTED value=''>Não há cargos cadastrados");
										echo ("</select>&nbsp;&nbsp;&nbsp;<a href='cadastraCarg.php'><img class='icons' src='../../imagens/icons/glyphicons_152_new_window.png' title='cadastrar cargo'></img></a></td>");
									}else{
									     foreach ($vetCarg as $item)
									       {
									    ?>
										    <option value="<?php echo $item->getCodigo(); ?>"><?php echo $item->getCargo()?></option>
									    <?php 									     } }
									    ?>    </select></td>
						</tr>
						<tr>
							<td>Escolaridade</td>
							<td><select name="escolaridade">
								<option value="Fundamental completo">Fundamental Completo</option>
								<option value="Médio incompleto">Médio Incompleto</option>
								<option value="Médio completo">Médio Completo</option>
								<option value="Técnico incompleto">Técnico incompleto</option>
								<option value="Técnico completo">Técnico Completo</option>
								<option value="Superior incompleto">Superior Incompleto</option>
								<option value="Superior completo">Superior Completo</option>
							</select></td>
						</tr>
						<tr>
							<th>Endereço</th>
						</tr>
						<tr>
							<td>CEP: </td>
							<td><span id="spanQuestao"><input name="cep" type="text" id="cep" maxlength="8" class="required digits" onchange="javascript: funcaowebservicecep();"></span></td>
							<td></td>
						</tr>
						<tr class="hide">
							<td>Logradouro: </td>
							<td><span id="spanQuestao"><input id="rua" name="rua" type="text" class="required"></span></td>
						</tr>
						<tr class="hide">
							<td>Numero: </td>
							<td><span id="spanQuestao"><input id="numero" name="numero" type="text" class="required"></span></td>
						</tr>
						<tr class="hide">
							<td>Complemento: </td>
							<td><span id="spanQuestao"><input id="complemento" name="complemento" type="text"></span></td>
						</tr>
						<tr class="hide"> 
							<td>Bairro: </td>
							<td><span id="spanQuestao"><input id="bairro" name="bairro" type="text" class="required"></span></td>
						</tr>
						<tr class="hide">
							<td>Cidade: </td>
							<td><span id="spanQuestao"><input id="cidade" name="cidade" type="text" class="required"></span></td>
						</tr>
						<tr class="hide">
							<td>UF: </td>
							<td><span id="spanQuestao"><input id="uf" name="uf" type="text" size="4"class="required"></span></td>
						</tr>
						<tr>
						
							<td ><input type="submit" name="Cadastrar" id="enviar"></td>	
							<td><input type="button" name="Cancelar" value="Limpar Campos" onclick="javascript:confirmarLimpeza();"></td>
						</tr>
					</table>
					<input type="hidden" name="acao" value="cadastrar">
				</form>
			</div>
			
				<div id="rodape">
			
				<?php include ("../../html/rodape.html");	?>			
				
			</div>
		</div>
	</body>
</html>
