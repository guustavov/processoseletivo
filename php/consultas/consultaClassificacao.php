<?php
	if(!isset($tipoRes)){
		$tipoRes = "";
	}
	if($tipoRes == 'tabela'){
		include_once 'resultadoClassificacao.php';

	}else if($tipoRes == 'mensagem'){
		echo ("<p align='center'><br><br>N�o foram encontrados itens que atendam
			aos crit�rios de pesquisa.<br>&nbsp;</p>");
		include_once 'consultaCandGrupo.php';
	}
?>	
