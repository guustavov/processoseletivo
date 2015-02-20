<?php				

	require_once ("../login/Seguranca.php"); 
	$seg = new Seguranca;

	$seg->protegePagina("cand"); 
?>