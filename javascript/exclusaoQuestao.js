function confirmarExclusao(codigo){
	var resposta = confirm("Deseja remover o registro '" + codigo + "'?");
	
	if(resposta == true){
		window.location.href="GerenciadorQuestao.php?acao=excluir&codigo=" + codigo;
	}
}