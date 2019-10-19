<div class="container-fluid">
	<div class="row singin">
		<img src="logo.png" alt="">
		<form>
			<input id="email" type="email" placeholder="Correo electr&oacute;nico" required>
			<input id="password" type="password" placeholder="Contrase&ntilde;a" required>
			<input type="button" onclick="login();" value="Ingresar">
		</form>
		<li><a data-toggle="modal" href="#myModal">Registrarme</a></li>
		<div class="col-md-6 col-md-offset-3">
			<div id="incorrectUser" class="alert alert-danger" role="alert" style="display:none;">
				<span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> 
				Usuario y/o contraseña incorrectos
			</div>
			<div id="inputsRequiredSingin" class="alert alert-warning" role="alert" style="display:none;">
				<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
				Todos los campos son requeridos
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  	<div class="modal-dialog" role="document">
	    	<div class="modal-content">
	      		<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        	<h4 class="modal-title" id="myModalLabel">Registro de usuario</h4>
	      		</div>
	      	<div class="modal-body create-user">
	      		<form class="form-horizontal">
				  	<div class="form-group">
				    	<label for="inputEmail3" class="col-sm-2 control-label">Correo electrónico: </label>
				    	<div class="col-sm-10">
				      		<input id="emailNew" type="email" class="form-control" placeholder="Digite su correo">
				    	</div>
				  	</div>
				  	<div class="form-group">
				    	<label for="inputPassword3" class="col-sm-2 control-label">Usuario: </label>
				    	<div class="col-sm-10">
				      		<input id="UserNew" type="text" class="form-control" placeholder="Digite el usuario">
				    	</div>
				  	</div>
				  	<div class="form-group">
				    	<label for="inputPassword3" class="col-sm-2 control-label">Contraseña: </label>
				    	<div class="col-sm-10">
				      		<input id="PasswordNew" type="password" class="form-control" placeholder="Digite la contraseña">
				    	</div>
				  	</div>
				  	<div class="form-group">
				    	<label for="inputPassword3" class="col-sm-2 control-label">Verificación: </label>
				    	<div class="col-sm-10">
				      		<input id="RePasswordNew" type="password" class="form-control" placeholder="Repita su contraseña">
				    	</div>
				  	</div>
				</form>
				<div id="exito" class="alert alert-success" role="alert">
					<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 
					Usuario registrado con exito
					
				</div>

	      		<div id="aviso" class="alert alert-warning" role="alert">
	      			<span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> 
	      			Ya existe un usuario con el mismo correo electrónico
	      			
	      		</div>

				<div id="samePassword" class="alert alert-warning" role="alert">
					<span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> 
					Debe de ingresar dos contraseñas iguales
					
				</div>
				<div id="inputsRequired" class="alert alert-warning" role="alert">
					<span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> 
					Todos los campos son requeridos
					
				</div>

				<div id="error" class="alert alert-danger" role="alert">
					<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> 
					Ocurrió un error inesperado
					
				</div>
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
	        	<button type="button" class="btn btn-success" onclick="insert();">Registrar</button>
	      	</div>
	    </div>
	  </div>
	</div>
</div>