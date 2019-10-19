(function(){

	//VARIABLES
	var btnclose = document.getElementById("close_session"),
	exito =  document.getElementById("exito"),
	aviso  = document.getElementById("aviso"),
	same  = document.getElementById("samePassword"),
	inputs  = document.getElementById("inputsRequired"),
	error  = document.getElementById("error");

	exito.style.display = "none";
	aviso.style.display = "none";
	same.style.display = "none";
	inputs.style.display = "none";
	error.style.display = "none";

	//FUNCIONES
	var closeSession = function(){
		location.href = 'index.php';
	};

	//EVENTOS
	btnclose.addEventListener("click", closeSession);
	
}());