<?php
	if(!isset($tipoRes)){
		$tipoRes = "";
	}
	if($tipoRes == 'tabela'){
		include_once 'resultadoGerarProva.php';
	}else if($tipoRes == 'mensagem'){
		echo ("<p align='center'><br><br>Chame o administrador<br>&nbsp;</p>");
	}
?>	
