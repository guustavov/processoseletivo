$('document').ready(function(){
	
	$('#formulario').validate();

	$('#nome').rules("add", {
		minlength: 3,
		messages: {
			minlength: jQuery.format("Digite {0} caracteres.")
		}
	});
	
	$('#rg').rules("add", {
		minlength: 8,	
		messages: {
			minlength: jQuery.format("Digite no mínimo {0} caracteres.")
		}
	});
	
	$('#cpf').rules("add", {
		minlength: 11,
		maxlength: 11,
		messages: {
			minlength: jQuery.format("Digite {0} caracteres.")
		}
	});
	
	$('#senha').rules("add", {
		minlength: 5,
		maxlength: 16,
		messages: {
			minlength: jQuery.format("Digite pelo menos {0} caracteres.")
		}
	});
	
	$('#confSenha').rules("add", {
		minlength: 5,
		maxlength: 16,
		equalTo: '#senha',
		messages: {
			minlength: jQuery.format("Digite pelo menos {0} caracteres."),
			equalTo: "Senha e confirmação de senha devem ser iguais."
		}
	});
	
	
	
});