(function(){

	//VARIABLES
	var btnComeBack = document.getElementById("come_back");
		

	//FUNCIONES
	
	var come = function(){
		location.href = 'principal-pane.php';
	};

	//EVENTOS
	btnComeBack.addEventListener("click", come); 
		
}());