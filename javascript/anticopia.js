function bloquear(e){return false}
function desbloquear(){return true}
	document.onselectstart=new Function (&quot;return false&quot;)
	if (window.sidebar){document.onmousedown=bloquear
	document.onclick=desbloquear}