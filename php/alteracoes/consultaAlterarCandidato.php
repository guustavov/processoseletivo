<?php
	if(!isset($tipoRes)){
		$tipoRes = "";
	}
	if($tipoRes == 'tabela'){
		if (isset($_GET["link"])){
				include_once 'resultadoAlterarCandidato.php?link=cand';
			}else{
				include_once 'resultadoAlterarCandidato.php';
			}
	}else if($tipoRes == 'mensagem'){
		echo("<p align='center'><br><br>N�o foram encontrados itens que atendam
			aos crit�rios de pesquisa.<br>&nbsp;</p>");
		include_once '../consultas/consultaCand.php';
	}
?>	
