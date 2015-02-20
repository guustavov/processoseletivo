<html>
	<head>
		<title>Alteração</title>
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
				
				<?php include ("../../html/cabecalho.html"); ?>
				
			</div>	

			<?php 
					require_once ("../dao/DaoCargo.php");
					$daoCarg = new DaoCargo;
					$vetCarg = $daoCarg->consultar();	
			?>

			<div id="menuLateral">
			
				<?php 
						include ("../../html/menuadmin.html"); 
					?>
				
			</div>
			
			<div id="conteudoResultado">	
				<h2 align="left">Alterar Candidato</h2>
				<hr>
				<form id="formulario" action="../gerenciadores/GerenciadorCandidato.php" method="POST">
			
					<table>
						<?php
							foreach($vetCand as $item){
								echo 
							"<tr>".
								"<td>Nome: </td>
								<td><span id='spanQuestao'><input type='text' name='nome' id='nome' value='".$item->getNome()."' class='required'></span></td>".
							"</tr>".
							"<tr>".
								"<td>RG: </td>
								<td><span id='spanQuestao'><input type='text' name='rg' id='rg' value='".$item->getRg()."' maxlength='10' class='required digits'></span></td>".
							"</tr>".
							"<tr>".
								"<td>Órgão Expeditor: </td>
								<td><span id='spanQuestao'><input type='text' name='expeditor' id='expeditor' value='".$item->getExpeditor()."'  onkeypress='return SemNumeros(event)' class='required' maxlength='6' size='5'>&nbsp;(Ex.: SSP/PR)</span></td>".
							"</tr>".
							"<tr>".
								"<td>CPF: </td>
								<td><span id='spanQuestao'><input type='text' name='cpf' id='cpf' value='".$item->getCpf()."' maxlength='11' class='required'><span class='alerta' id='invalido'>CPF inválido.</span></span></td>".
							"</tr>".
							"<tr>".
							"<td>Data de Nascimento </td>
								<td><span id='spanQuestao'><input type='text' name='data_nascimento' id='data' value='".$item->getData_nascimento()."' maxlength='10' class='required'></span></td>".
							"</tr>".
							"<tr>".
								"<td>Telefone: </td>
								<td><span id='spanQuestao'><input type='text' name='telefone' value='".$item->getTelefone()."' id='telefone' class='required digits'></span></td>".
							"</tr>".
							"<tr>".
								"<td>Email: </td>
								<td><span id='spanQuestao'><input type='text' name='email' id='email' value='".$item->getEmail()."' class='required email'></span></td>".
							"</tr>".
							"<tr>".
								"<td>Senha: </td>
								<td><span id='spanQuestao'><input type='password' name='senha'  id='senha' value='".$item->getSenha()."' class='required'></span></td>".
							"</tr>".
							"<tr>".
								"<td>Confirmação de Senha: </td>
								<td><span id='spanQuestao'><input type='password' name='confSenha' value='".$item->getSenha()."' id='confSenha' class='required'></span></td>".
							"</tr>".
							"<input type='hidden' name='id' value='".$item->getCodigo()."'>".
							"<tr>
							<td>Cargo a concorrer</td>
							<td>  <select name='cargo' disabled='disabled'>";
									
									     foreach ($vetCarg as $item2){
										   echo " <option value=". $item2->getCodigo() . ">" . $item2->getCargo() . "</option>";
										} 
										
							echo  " </select>
							</td>
							</tr>
							<tr>
								<td>Escolaridade</td>
								<td><select name='escolaridade'>
									<option value='Fundamental completo'>Fundamental Completo</option>
									<option value='Médio incompleto'>Médio Incompleto</option>
									<option value='Médio completo'>Médio Completo</option>
									<option value='Técnico incompleto'>Técnico incompleto</option>
									<option value='Técnico completo'>Técnico Completo</option>
									<option value='Superior incompleto'>Superior Incompleto</option>
									<option value='Superior completo'>Superior Completo</option>
								</select></td>
							</tr>
							<tr>
								<th>Endereço</th>
							</tr>
							<tr>
								<td>CEP: </td>
								<td><span id='spanQuestao'><input name='cep' type='text' id='cep' maxlength='9' onchange='javascript: funcaowebservicecep();' value=".$item->getCep()." id='cep' class='required digits'></span></td>".
								"<td></td>".
							"</tr>".
							"<tr>".
								"<td>Logradouro: </td> ".
								"<td><span id='spanQuestao'><input id='rua' name='rua' type='text' value='".$item->getRua()."' class='required'></span></td>".
							"</tr>".
							"<tr>".
								"<td>Numero: </td>".
								"<td><span id='spanQuestao'><input id='numero' name='numero' type='text' value='".$item->getNumero()."' class='required digits'></span></td>".
							"</tr>".
							"<tr>".
								"<td>Complemento: </td>".
								"<td><span id='spanQuestao'><input id='complemento' name='complemento' type='text' value='".$item->getComplemento()."'></span></td>".
							"</tr>".
							"<tr> ".
								"<td>Bairro: </td>".
								"<td><span id='spanQuestao'><input id='bairro' name='bairro' type='text' value='".$item->getBairro()."' class='required'></span></td>".
							"</tr>".
							"<tr>".
								"<td>Cidade: </td>".
								"<td><span id='spanQuestao'><input id='cidade' name='cidade' type='text'  value='".$item->getCidade()."' class='required'></span></td>".
							"</tr>".
							"<tr>".
								"<td>UF: </td>".
								"<td><span id='spanQuestao'><input id='uf' name='uf' type='text' size='4'  value='".$item->getEstado()."' class='required'></span></td>".
							"</tr>";						
							}
						?>
						<tr>
							<td><input type="submit" name="Atualizar" id="enviar"></td>
							<td><input type="reset" name="Cancelar" value="Restaurar Campos"></td>
							<input type="hidden" name="acao" value="atualizar">
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
