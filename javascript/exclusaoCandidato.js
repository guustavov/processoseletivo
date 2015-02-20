function confirmarExclusao(nome, codigo){
	var resposta = confirm("Deseja remover o registro '" + nome + "'?");
	
	if(resposta == true){
		window.location.href="../gerenciadores/GerenciadorCandidato.php?acao=excluir&codigo=" + codigo;
	}
}