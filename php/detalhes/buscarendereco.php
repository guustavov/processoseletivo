<?
	$consulta = 'http://viavirtual.com.br/webservicecep.php?cep='.$_GET['cep'];
	$consulta = file($consulta);
	$consulta = explode('||',$consulta[0]);
	// Caso seja necessário poderá salvar os dados em SESSION
	$rua=utf8_encode($consulta[0]);
	$bairro=utf8_encode($consulta[1]);
	$cidade=utf8_encode($consulta[2]);
	$uf=$consulta[4];
?>

{"rua":"<? echo $rua; ?>","bairro":"<? echo $bairro; ?>","cidade":"<? echo $cidade; ?>","uf":"<? echo $uf; ?>"}