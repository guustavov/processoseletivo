$('document').ready(function(){	
//Descrição
	var text = $('#textareaD').val();
	$('#textareaD').bind('focusin', someTexto);
	$('#textareaD').bind('focusout', apareceTexto);	
	
	function someTexto(){
		var text2 = $(this).val();
		if (text2 == text){
			$(this).val('');
		}else{
			$(this).val(text2);
		}
	}	
	function apareceTexto(){
		var text2 = $(this).val();
		
		if (text2 == ''){
			$(this).val(text);
		}else{
			$(this).val(text2);
		}
	}
	
//Alternativa A
	var textA = $('#textareaAA').val();
	$('#textareaAA').bind('focusin', someTextoA);
	$('#textareaAA').bind('focusout', apareceTextoA);	
	
	function someTextoA(){
		var text2 = $(this).val();
		if (text2 == textA){
			$(this).val('');
		}else{
			$(this).val(text2);
		}
	}	
	function apareceTextoA(){
		var text2 = $(this).val();
		
		if (text2 == ''){
			$(this).val(textA);
		}else{
			$(this).val(text2);
		}
	}	
	
//Alternativa B
	var textB = $('#textareaAB').val();
	$('#textareaAB').bind('focusin', someTextoB);
	$('#textareaAB').bind('focusout', apareceTextoB);	
	
	function someTextoB(){
		var text2 = $(this).val();
		if (text2 == textB){
			$(this).val('');
		}else{
			$(this).val(text2);
		}
	}	
	function apareceTextoB(){
		var text2 = $(this).val();
		
		if (text2 == ''){
			$(this).val(textB);
		}else{
			$(this).val(text2);
		}
	}
	
//Alternativa C
	var textC = $('#textareaAC').val();
	$('#textareaAC').bind('focusin', someTextoC);
	$('#textareaAC').bind('focusout', apareceTextoC);	
	
	function someTextoC(){
		var text2 = $(this).val();
		if (text2 == textC){
			$(this).val('');
		}else{
			$(this).val(text2);
		}
	}	
	function apareceTextoC(){
		var text2 = $(this).val();
		
		if (text2 == ''){
			$(this).val(textC);
		}else{
			$(this).val(text2);
		}
	}
	
//Alternativa D
	var textD = $('#textareaAD').val();
	$('#textareaAD').bind('focusin', someTextoD);
	$('#textareaAD').bind('focusout', apareceTextoD);	
	
	function someTextoD(){
		var text2 = $(this).val();
		if (text2 == textD){
			$(this).val('');
		}else{
			$(this).val(text2);
		}
	}	
	function apareceTextoD(){
		var text2 = $(this).val();
		
		if (text2 == ''){
			$(this).val(textD);
		}else{
			$(this).val(text2);
		}
	}
});