<?php include'header.php'; ?>
<?php
	require("php/conexion.php");
	$profile = $_GET["profile"];

	$conexion = mysqli_connect($server, $user, $password, $database);
	if(mysqli_connect_errno()){
		echo "<script type='text/javascript'>alert('La conexion con el servidor ha fallado');</script>";
		exit();	
	}
	mysqli_set_charset($conexion, 'utf8');
	$consulta = "SELECT email, puntuation, user_name FROM users where email= '$profile'";
	$resultado = mysqli_query($conexion, $consulta);
	if($resultado){
		$row = mysqli_fetch_array($resultado);

?>
<div class="container-fluid">
	<div class="row  singin principal" style="height:600px;">
		<!-- Modal -->
		<div class="modal show" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-top:90px;">
		  	<div class="modal-dialog" role="document">
		    	<div class="modal-content">
			      	<div class="modal-header">
			        	<h4 class="modal-title" id="myModalLabel">PERFIL DE USUARIO</h4>
			      	</div>
			      	<div class="modal-body">
				        <p><strong>Correo electr&oacute;nico: </strong> <?php echo $row[0]; ?></p>
						<p><strong>Nombre de usuario: </strong> <?php echo $row[2]; ?></p>
						<p><strong>Puntaje: </strong> <?php echo $row[1]; ?></p>
			      	</div>
			      	<div class="modal-footer">
			        	<button id="come_back" type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Regresar</button>
			      	</div>
		    	</div>
		  	</div>
		</div>
	</div>
</div>

<?php
	}else{
		echo "<script type='text/javascript'>alert('Ocurrió un error inesperado');</script>";
	}
	mysqli_close($conexion);

include'footer-two.php'; 
 ?>