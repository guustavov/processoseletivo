$(document).ready(function(){
	$('.alerta').hide();
	$('#cpf').bind('change', validar);
	
	function validar(){
		var tamanho = $("#cpf").val().length;
		if (tamanho==11){
			valido = validarCpf($('#cpf').val());

			$('.alerta').hide();
					
			if (!valido) {
				$('#invalido').show();
				$('#enviar').attr('disabled', '');
			}else{
				$('#invalido').hide();
				$('#enviar').removeAttr('disabled');
			}
		}
	}
});
function validarCpf (arg) {
	vetor = arg.split("");

	valido = true;
	somax = 0;
	multiplicadorx = 10;
	somay = 0;
	
	for(c = 0; c < 9; c++){
		somax = somax + (vetor[c] * multiplicadorx);
		somay = somay + (vetor[c] * (multiplicadorx + 1));
		multiplicadorx--;
	}
	
	somay = somay + (vetor[9] * 2);

	if ((somax % 11)  < 2){
		if (vetor[9] != 0){
			valido = false;
		}
	}else{
		if (vetor[9] != (11 - (somax % 11))){
			valido = false;
		}
	}

	if(valido){

		if ((somay % 11)  < 2){
			if (vetor[10] != 0){
				valido = false;
			}
		}else{
			if (vetor[10] != (11 - (somay % 11))){
				valido = false;
			}
		}
		
	}

	return valido;
}