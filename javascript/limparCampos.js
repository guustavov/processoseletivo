function confirmarLimpeza(){
	var resposta = confirm("Deseja mesmo limpar todos os campos?");
	
	if(resposta == true){
		document.formulario.reset();
	}
}