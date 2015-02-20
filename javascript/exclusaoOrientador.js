function confirmarExclusao(nome, codigo){
	var resposta = confirm("Deseja remover o registro '" + nome + "'?");
	
	if(resposta == true){
		window.location.href="../gerenciadores/GerenciadorOrientador.php?acao=excluir&codigo=" + codigo;
	}
}