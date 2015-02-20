<?php
	if(!isset($tipoRes)){
		$tipoRes = "";
	}
	if($tipoRes == 'tabela'){
		include_once 'resultadoDisciplina.php';
	}else if($tipoRes == 'mensagem'){
		echo("<p align='center'><br><br>Não foram encontrados itens que atendam
			aos critérios de pesquisa.<br>&nbsp;</p>");
		include_once 'consultaDisci.php';
	}else{
	}
?>	
