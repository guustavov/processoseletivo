<?php
	if(!isset($tipoRes)){
		$tipoRes = "";
	}
	if($tipoRes == 'tabela'){
		include_once 'resultadoGrupo.php';
	}else if($tipoRes == 'mensagem'){
		echo("N�o foram encontrados itens que atendam
			aos crit�rios de pesquisa.");
		include_once 'consultaGrup.php';
	}else{
	}
?>	
