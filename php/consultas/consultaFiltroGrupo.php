<?php
	if(!isset($tipoRes)){
		$tipoRes = "";
	}
	if($tipoRes == 'tabela'){
	
		$tipo = $_POST["tipo"];
		$valor = $_POST["campo"];
		include_once 'resultadoFiltroGrupo.php';
		
	}else if($tipoRes == 'mensagem'){
		echo("<p align='center'><br><br>N�o foram encontrados itens que atendam
			aos crit�rios de pesquisa.<br>&nbsp;</p>");
		include_once 'consultaGrup.php';
	}else{
		include_once 'consultaGrup.php';
	}
?>	
