<?php
	if(!isset($tipoRes)){
		$tipoRes = "";
	}
	if($tipoRes == 'tabela'){
	
		$tipo = $_POST["tipo"];
		if(isset($_POST['campo'])){
			$valor = $_POST["campo"];
		}else{
			$valor = null;
		}
		include_once 'resultadoFiltroQuestao.php';
		
	}else if($tipoRes == 'mensagem'){
		echo("<p align='center'><br><br>N�o foram encontrados itens que atendam
			aos crit�rios de pesquisa.<br>&nbsp;</p>");
		include_once 'consultaQues.php';
	}else{
		include_once 'consultaQues.php';
	}
?>	
