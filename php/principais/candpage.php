<html>
	<head>
		<title>Administração</title>
		<link type="text/css" rel="stylesheet" href="../../css/estilo.css" />
		<script src= "../../javascript/jquery/jquery-1.8.2.min.js" ></script>
		<script src="../../javascript/jquery/jquery-ui-1.8.20.custom.min.js"></script>
		<script src="../../javascript/jquery/jquery.validate.js"></script>
		<script language="JavaScript" src="../../javascript/anticopia.js"></script>
		<script>
			$(document).ready(function(){
				$('.consulta tr:odd').addClass('par');
			});
		</script>	
				
		<script>
			$(document).ready(function(){
				var codigo = $("#codigo").val();
				var intervalo = setInterval(function() { 
					$('#tempo').load("../detalhes/tempo.php?codigo="+codigo+""); 
					
					if($("#hide").text() == "yes"){
						$("#tempo").hide();
					}
				}, 1000);
				
			});
	</script>
	</head>
	<body>
		<div id="externa">
		
			<div id="cabecalho">
			<?php								
				include ("../../html/cabecalho.html");
				
				include("../login/protegePaginaCand.php"); 
							
				require_once ("../dao/DaoCandidato.php");
				$daoCand = new DaoCandidato;
				$vetCand = $daoCand->consultarFiltro("email", $_SESSION['usuarioLogin']);	
				
				require_once ("../dao/DaoProva.php");
				$daoProva = new DaoProva;
				
				$_SESSION["data_realizacao"] = strtotime($daoProva->verificarData($_SESSION["usuarioID"]));	
				$_SESSION["duracao"] = $daoProva->verificarDuracao($_SESSION["usuarioID"]);					
								
			?>
			</div>
						
			<div id="conteudo">
				<form id="formulario" action="../gerenciadores/GerenciadorGrupo.php" method="POST">
					<p class="titulo">Informações Gerais</p>
					<table class="consulta" width="500" >
					<?php
										
						foreach($vetCand as $item){						
								echo "<tr>".
									"<td width='200px' align='center' colspan='2'><span class='nome'>".$item->getNome()."</span></td>".
									"<td><a href='../gerenciadores/GerenciadorCandidato.php?acao=alterar&codigo=".$item->getCodigo()."&link=cand'><img class='icons' src='../../imagens/icons/glyphicons_151_edit.png' title='editar'></a></td>".
									"</tr>".
									"<tr><th>RG</th><td colspan='2'>".$item->getRg()." (".$item->getExpeditor().")</td></tr>".
									"<tr><th>CPF</th><td  colspan='2'>".$item->getCpf()."</td></tr>".
									"<tr><th>Email</th><td  colspan='2'>".$item->getEmail()."</td></tr>".
									"<tr><th>Senha</th><td  colspan='2'>".$item->getSenha()."</td>".
									"<tr><th>Cargo</th><td  colspan='2'>".$item->getCargo()."</td></tr>".
									"<tr><th>Escolaridade</th><td  colspan='2'>".$item->getEscolaridade()."</td></tr>".
									"<tr><th>Telefone</th><td  colspan='2'>".$item->getTelefone()."</td></tr>".
							

									"</tr><tr>".
											"<th>Endereço:</th>".
											"<td>".$item->getRua().", ".
											$item->getNumero().", ".
											$item->getBairro().", ".
											"".$item->getComplemento()." <br> ".
											$item->getCidade().
											" (".$item->getEstado()."). &nbsp;&nbsp;".
											
											" <b>CEP:</b> ".$item->getCep()."</td>";
									echo 	'<input type="hidden" name="codigo_candidato" id="codigo" value="'.$item->getCodigo().'">';
									
							}
						?>
							</tr>
						</table>
						<BR>
						<input type="hidden" name="acao" value="gerarProva">
						<div align="center"><input type="submit" name="Confirmar" id="confirmar" value='  Confirmar dados  ' ></div>
					</form>			
			</div>
			
			<div id='tempo'>
			
		
			</div>
		
				<div id="rodape"> 
				
			<?php
				
				include ("../../html/rodape.html");	
			
			?>

			</div>
		</div>
	</body>
</html> 