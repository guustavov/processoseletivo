$('document').ready(function(){
	$(".hide").hide();
	var cont = 0;
	
	$("#cep").bind("change", mostraTudo);
		
	function mostraTudo(){
		var tamanho = $("#cep").val().length;
		if (tamanho==8){
			$(".hide").show();
		}
	}
});