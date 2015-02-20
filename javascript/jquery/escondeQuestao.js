$('document').ready(function(){
	$("th").hide();
	$(".hide").hide();
	$("th.show").show();
	
	var cont = 0;
	$(".mais").bind('click', mostraTd);
	
	function mostraTd(){
		var codigo = $(this).attr('id');
		
		
		if($(this).attr('src') == '../../imagens/icons/glyphicons_191_circle_minus.png'){
			$("#A"+codigo).hide();
			$("#B"+codigo).hide();
			$("#C"+codigo).hide();
			$("#D"+codigo).hide();
			$("#gabarito"+codigo).hide();
			$(".th"+codigo).hide();
			$(this).attr('src', '../../imagens/icons/glyphicons_190_circle_plus.png');
			$(this).attr('title', 'mais resultados');
			cont=cont - 1;
			if (cont==0){
				$("th").hide();
				$("th.show").show();
			}
		}else{			
			$(".th"+codigo).show();
			$("#A"+codigo).show();
			$("#B"+codigo).show();
			$("#C"+codigo).show();
			$("#D"+codigo).show();
			$("#gabarito"+codigo).show();
			
			$(this).attr('src', '../../imagens/icons/glyphicons_191_circle_minus.png');
			$(this).attr('title', 'menos resultados');
			cont=cont+1;
		}
	}
});