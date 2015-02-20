<?php
	if(!isset($tipoRes)){
		$tipoRes = "";
	}
	if($tipoRes == 'tabela'){
		include_once 'resultadoGrupo.php';
	}else if($tipoRes == 'mensagem'){
		echo("Não foram encontrados itens que atendam
			aos critérios de pesquisa.");
		include_once 'consultaGrup.php';
	}else{
	}
?>	
