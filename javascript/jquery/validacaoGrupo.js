$('document').ready(function(){
	
	$('#formulario').validate();
	
	$('#tempo').rules("add", {
		minlength: 1,	
		messages: {
			minlength: jQuery.format("Digite no m�nimo {0} caracteres.")
		}
	});	
	
});