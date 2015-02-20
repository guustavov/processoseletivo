<html>
	<head>
		<title>Administração</title>
		<link type="text/css" rel="stylesheet" href="../../css/estilo.css" />
		<script src= "../../javascript/jquery/jquery-1.8.2.min.js" ></script>
		<script src="../../javascript/jquery/jquery-ui-1.8.20.custom.min.js"></script>
		
	</head>
	<script>
		$('document').ready(function(){
			if ($("#grupo").val() == ''){
				$('#enviar').attr('disabled', '');
			}
		});
	</script>
	<body onselectstart="return false">
		<div id="externa">
		
			<div id="cabecalho">
				<?php
					include("../login/protegePaginaAdmin.php"); 
					
					include ("../../html/cabecalho.html");
				?>
			</div>
			
			<?php 
					require_once ("../dao/DaoGrupo.php");
					$daoGrupo = new DaoGrupo;
					$vetGrup = $daoGrupo->consultar();	

			?>
			
			<div id="menuLateral">
				<?php
				include ("../../html/menuadmin.html");
				?>
				
			</div>
			
			<div id="conteudo">
				<h2>Consulta Classificação</h2>

				<form action="../gerenciadores/GerenciadorGrupo.php" method="POST">
						<table>
							<tr>
								<td>Selecione o grupo: </td>
							</tr>
								<td><select name="grupo" id='grupo'>
									 <?php
									if($vetGrup == null){
										echo ("<OPTION SELECTED value=''>Grupo não disponível");
									}else{
									     foreach ($vetGrup as $item)
									       {
									    ?>
										    <option value="<?php echo $item->getCodigo(); ?>"><?php echo $item->getNome()?></option>
									    <?php 									     } }
									    ?>    </select></td>
							</tr>
							<tr>
								<td>
									<input class="consultaGeral" type="submit" value="Consultar" id="enviar"/>
									<input type="hidden" name="acao" value="consultarClassificacao">
								</td>
						</table>
					</form>
				</div>
			
				<div id="rodape">
				<?php
					include ("../../html/rodape.html");				
				?>
			</div>
		</div>
	</body>
</html>
