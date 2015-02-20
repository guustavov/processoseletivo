function confirmarExclusao(disciplina, codigo){
	var resposta = confirm("Deseja remover o registro '" + disciplina + "'?");
	
	if(resposta == true){
		window.location.href="GerenciadorDisciplina.php?acao=excluir&codigo=" + codigo;
	}
}