<?php include("php/seguridad_administrator.php"); ?> 
<?php include'header.php'; ?>
<?php
	require("php/conexion.php");
	$ronda = "";
	$username = $_SESSION["userAdministrator"];
	$conexion = mysqli_connect($server, $user, $password, $database);
	if(mysqli_connect_errno()){
		echo "<script type='text/javascript'>alert('La conexion con el servidor ha fallado');</script>";
		exit();	
	}
	mysqli_set_charset($conexion, 'utf8');
	$consulta = "SELECT email, user_name, puntuation FROM users order by puntuation desc";
	$resultado = mysqli_query($conexion, $consulta);
	
	if($resultado){
		$cont = 1;
?>
<div class="container-fluid">
	<div class="row singin principal">
		<h3>Usuario: <strong style="color:#7a2121; text-decoration:underline;"><?php echo $username?></strong></h3>
		<div>
		  	<!-- Nav tabs -->
		  	<ul class="nav nav-tabs" role="tablist">
		    	<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">TABLA GENERAL</a></li>
		    	<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">JORNADA ACTUAL</a></li>
		    	<li role="presentation"><a href="#country" aria-controls="country" role="tab" data-toggle="tab">PAISES</a></li>
		    	<li role="presentation"><a href="#rondas" aria-controls="rondas" role="tab" data-toggle="tab">RONDAS</a></li>
		    	<li role="presentation"><a href="#nueva_ronda" aria-controls="nueva_ronda" role="tab" data-toggle="tab">CREAR NUEVA RONDA</a></li>
		    	<li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">PERFIL</a></li>
		  	</ul>
			<br> <br>
		  	<!-- Tab panes -->
		  	<div class="tab-content">
		    	<div role="tabpanel" class="tab-pane active" id="home">
		    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="panel panel-success">
							<div class="panel-heading">
						    	<h3 class="panel-title"><strong>TABLA GENERAL DE LA QUINIELA - COPA AMERICA</strong></h3>
						  	</div>
						  	<!-- IMPORTANT: IT ALLOWS THE TABLE TO BE RESPONSIVE -->
						  	<div id="source_code_content" class="tab-content">	
								<div id="tbl_container_demo_grid1" class="table-responsive">
									<table id="list" class="table table-bordered table-hover">
										<!-- TABLE HEAD -->
										<thead>
											<tr id="tbl_demo_grid1_tr_0">
												<th class="th-common">
													Posición
												</th>
												<th class="th-common">
													Usuario
												</th>
												<th class="th-common">
													Puntaje
												</th>
											</tr>
										</thead>
										<!-- FINISH TABLE HEAD -->

										<!-- TABLE BODY -->
										<tbody id="table-body" style="cursor:pointer;">
											<?php
												while($row = mysqli_fetch_array($resultado)){
													echo "<tr><td>";
													echo $cont . "</td><td>";
													if($row[1] != NULL){
														echo $row[1] . "</td><td>";
													}else{
														echo $row[0] . "</td><td>";
													}
													echo $row[2] . "</td></tr>";
													$cont++;
												}
											?>
										</tbody>
										<!-- FINISH TABLE BODY -->
									</table>
								</div>
							</div>
							<!-- FINISH TABLE RESPONSIVE -->
						</div>
					</div>
					<!-- FINISH ADDED LIST ARTICLES-->
		    	</div>

		    	<div role="tabpanel" class="tab-pane" id="profile">
		    		<?php
	    		$consulta = "SELECT * FROM round WHERE is_active = true";
	    		$resultado = mysqli_query($conexion, $consulta);
	    		if($resultado){ //resultado

	    			while($fila = mysqli_fetch_array($resultado)){ //while resultado	
			?>    			
		    			<h2 style="background: white;color: #999;padding: 10px;"><?php echo $fila[1]?></h2>
			<?php
						$ronda = $fila[0];
						$consultaCountryRound = 
				    		"SELECT cr.*, c.description, c2.description 
				    		FROM country_round cr, country c, country c2 
				    		WHERE 
				    		cr.id_round       = $fila[0] AND
				    		cr.id_country_one = c.id AND 
				    		cr.id_country_two = c2.id;";
			    		$resultadoCountryRound = mysqli_query($conexion, $consultaCountryRound);
			    		if($resultadoCountryRound){ //resultadoCountryRound
			    			while($filaCountryRound = mysqli_fetch_array($resultadoCountryRound)){ //while resultadoCountryRound
			?>
						    	<div class="col-md-3 votation">
					    			<div class="votation-head">
					    				<p><strong>Partido:</strong> <?php echo $filaCountryRound[7] . " vrs " . $filaCountryRound[8]; ?></p>
					    				<p><strong>Hora:</strong> <?php echo $filaCountryRound[5]; ?></p>
					    				<p><strong>Estadio:</strong> <?php echo $filaCountryRound[4]; ?></p>	
					    			</div>
									<?php
										$consultaUser = 
										"SELECT correct_result_country_one, correct_result_country_two
										FROM results 
										WHERE id_user = '$username' AND 
										id_round = $fila[0] AND 
										id_country_one = $filaCountryRound[1] AND 
										id_country_two = $filaCountryRound[2]";
										$resultadoUser = mysqli_query($conexion, $consultaUser);
										if($resultadoUser){ //resultadoUser
											$filaUser = mysqli_fetch_array($resultadoUser);
											if($filaUser[0] != NULL){ //resultadoUser two
									?>
												<form class="form-inline" action="php/votation-modified-administrator.php" method="GET">
													<input class="identificators" type="text" name="id_username" value="<?php echo $username ?>" >
								    				<input class="identificators" type="text" name="id_round" value="<?php echo $fila[0];?>" >
												  	<input class="identificators" type="text" name="id_country_one" value="<?php echo $filaCountryRound[1]; ?>" >
												  	<input class="identificators" type="text" name="id_country_two" value="<?php echo $filaCountryRound[2]; ?>" >

												  	<div class="form-group">
													    <div class="input-group">
													      	<div class="input-group-addon">
													      		<?php echo $filaCountryRound[7]; ?>
													      	</div>
						      								<input type="number" name="country_one" class="form-control" value="<?php echo $filaUser[0];?>" id="exampleInputAmount" min="0" max="99" required>
							      						</div>
												  	</div>
												  	
												  	<div class="form-group">
													    <div class="input-group">
													      	<div class="input-group-addon">
													      		<?php echo $filaCountryRound[8]; ?>
													      	</div>
							      							<input type="number" name="country_two" class="form-control" value="<?php echo $filaUser[1];?>" id="exampleInputAmount" min="0" max="99" required>
													    </div>
												  	</div>
				      								<input type="submit" class="btn btn-primary" value="Modificar"></input>
												</form>
									<?php
											}else{ //end resultadoUser two and begin else resultadoUser two
									?>
												<form class="form-inline" action="php/votation-administrator.php" method="GET">
													<input class="identificators" type="text" name="id_username" value="<?php echo $username ?>" >
								    				<input class="identificators" type="text" name="id_round" value="<?php echo $fila[0];?>" >
												  	<input class="identificators" type="text" name="id_country_one" value="<?php echo $filaCountryRound[1]; ?>" >
												  	<input class="identificators" type="text" name="id_country_two" value="<?php echo $filaCountryRound[2]; ?>" >

												  	<div class="form-group">
													    <div class="input-group">
													      	<div class="input-group-addon">
													      		<?php echo $filaCountryRound[7]; ?>
													      	</div>
										      				<input type="number" name="country_one" class="form-control" value="0" id="exampleInputAmount" min="0" max="99" required>
													    </div>
												  	</div>
												  	
												  	<div class="form-group">
													    <div class="input-group">
													      	<div class="input-group-addon">
													      		<?php echo $filaCountryRound[8]; ?>
													      	</div>
												      		<input type="number" name="country_two" class="form-control" value="0" id="exampleInputAmount" min="0" max="99" required>
													    </div>
												  	</div>
								  					<input type="submit" class="btn btn-primary" value="Votar"></input>
												</form>
			<?php
											}//end else resultadoUser two
										}else{break;}//resultadoUser
							
			?>
					    		</div>
			<?php
							}//end while resultadoCountryRound
						}else{break;}//end resultadoCountryRound
	    			}//end while resultado
	    		}else{break;}//end resultado
	    	?>	

		    		<div class="col-md-12">
		    			<div class="row">
		    				<form action="php/close_round.php" method="GET">
		    					<input type="text" name="id_round_close" class="identificators" value="<?php echo $ronda; ?>">
		    					<input type="submit" value="Cerrar jornada">
		    				</form>
		    			</div>
		    		</div>
		    	</div>
				
				<div role="tabpanel" class="tab-pane" id="messages">
		    		<div class="row">
		    			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="panel panel-success">
							<div class="panel-heading">
						    	<h3 class="panel-title"><strong>Datos generales del usuario - COPA AMERICA</strong></h3>
						  	</div>
						  	<!-- IMPORTANT: IT ALLOWS THE TABLE TO BE RESPONSIVE -->
						  	<div id="source_code_content" class="tab-content">	
								<div id="tbl_container_demo_grid1" class="table-responsive">
									<table id="list" class="table table-bordered table-hover">
										<!-- TABLE HEAD -->
										<thead>
											<tr id="tbl_demo_grid1_tr_0">
												<th class="th-common">
													Usuario
												</th>
												<th class="th-common">
													Puntaje
												</th>
											</tr>
										</thead>
										<!-- FINISH TABLE HEAD -->
										<?php
											$consultatres = "SELECT email, puntuation FROM users where email = '$username'";
											$resultadotres = mysqli_query($conexion, $consultatres);

											if($resultadotres){
										?>
										<!-- TABLE BODY -->
										<tbody id="table-body" style="cursor:pointer;">
											<?php
												while($rowtres = mysqli_fetch_array($resultadotres)){
													echo "<tr><td>";
													echo $rowtres['email'] . "</td><td>";
													echo $rowtres['puntuation'] . "</td></tr>";
												}
												
											?>
										</tbody>
										<!-- FINISH TABLE BODY -->
										<?php
											}else{
												echo "<script type='text/javascript'>alert('Ocurrió un error inesperado');</script>";
											}
										?>
									</table>
								</div>
							</div>
							<!-- FINISH TABLE RESPONSIVE -->
						</div>
					</div>
		    			<form action="php/salir.php">
		    				<input type="submit" class="btn btn-danger" value="Cerrar sesión">
		    			</form>
		    		</div>
		    	</div>

		    	<div role="tabpanel" class="tab-pane" id="country">
		    		<div class="col-md-8 col-md-offset-2 other">
		    			<form action="php/country.php" method="GET">
			    			<input type="text" name="pais" placeholder="Digite el nombre del país">
			    			<input type="submit" name="agregar" value="Agregar">
			    		</form>
		    		</div>
		    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="panel panel-success">
							<div class="panel-heading">
						    	<h3 class="panel-title"><strong>PAISES - COPA AMERICA</strong></h3>
						  	</div>
				    		<!-- IMPORTANT: IT ALLOWS THE TABLE TO BE RESPONSIVE -->
						  	<div id="source_code_content" class="tab-content">	
								<div id="tbl_container_demo_grid1" class="table-responsive">
									<table id="list" class="table table-bordered table-hover">
										<!-- TABLE HEAD -->
										<thead>
											<tr id="tbl_demo_grid1_tr_0">
												<th class="th-common">
													ID
												</th>
												<th class="th-common">
													NOMBRE DEL PAÍS
												</th>
											</tr>
										</thead>
										<!-- FINISH TABLE HEAD -->
										<?php
											$consultatres = "SELECT * FROM country";
											$resultadotres = mysqli_query($conexion, $consultatres);

											if($resultadotres){
										?>
										<!-- TABLE BODY -->
										<tbody id="table-body" style="cursor:pointer;">
											<?php
												while($rowtres = mysqli_fetch_array($resultadotres)){
													echo "<tr><td>";
													echo $rowtres['id'] . "</td><td>";
													echo $rowtres['description'] . "</td></tr>";
												}
												
											?>
										</tbody>
										<!-- FINISH TABLE BODY -->
										<?php
											}else{
												echo "<script type='text/javascript'>alert('Ocurrió un error inesperado');</script>";
											}
										?>
									</table>
								</div>
							</div>
							<!-- FINISH TABLE RESPONSIVE -->
						</div>
					</div>
		    	</div>

		    	<div role="tabpanel" class="tab-pane" id="rondas">
		    		<div class="col-md-8 col-md-offset-2 other">
			    		<form action="php/ronda.php" method="GET">
			    			<input type="text" name="nombre_ronda" placeholder="Digite el nombre de la ronda">
			    			<input type="submit" name="agregar" value="Agregar">
			    		</form>
		    		</div>
		    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="panel panel-success">
							<div class="panel-heading">
						    	<h3 class="panel-title"><strong>RONDAS - COPA AMERICA</strong></h3>
						  	</div>
				    		<!-- IMPORTANT: IT ALLOWS THE TABLE TO BE RESPONSIVE -->
						  	<div id="source_code_content" class="tab-content">	
								<div id="tbl_container_demo_grid1" class="table-responsive">
									<table id="list" class="table table-bordered table-hover">
										<!-- TABLE HEAD -->
										<thead>
											<tr id="tbl_demo_grid1_tr_0">
												<th class="th-common">
													ID
												</th>
												<th class="th-common">
													NOMBRE DEL PAÍS
												</th>
												<th class="th-common">
													Fecha
												</th>
												<th class="th-common">
													Activo
												</th>
											</tr>
										</thead>
										<!-- FINISH TABLE HEAD -->
										<?php
											$consultatres = "SELECT * FROM round";
											$resultadotres = mysqli_query($conexion, $consultatres);

											if($resultadotres){
										?>
										<!-- TABLE BODY -->
										<tbody id="table-body" style="cursor:pointer;">
											<?php
												while($rowtres = mysqli_fetch_array($resultadotres)){
													echo "<tr><td>";
													echo $rowtres[0] . "</td><td>";
													echo $rowtres[1] . "</td><td>";
													echo $rowtres[2] . "</td><td>";
													echo $rowtres[3] . "</td></tr>";
												}
												
											?>
										</tbody>
										<!-- FINISH TABLE BODY -->
										<?php
											}else{
												echo "<script type='text/javascript'>alert('Ocurrió un error inesperado');</script>";
											}
										?>
									</table>
								</div>
							</div>
							<!-- FINISH TABLE RESPONSIVE -->
						</div>
					</div>
		    	</div>

		    	<div role="tabpanel" class="tab-pane" id="nueva_ronda">
		    		<div class="col-md-8 col-md-offset-2 other">
		    			<?php
							$consultatres = "SELECT * FROM round";
							$resultadotres = mysqli_query($conexion, $consultatres);

							if($resultadotres){
						?>
			    		<form action="php/insert_country_round.php" method="GET">
			    			<label for="" style="font-size:20px; text-align:left">RONDA:</label>
			    			<select name="ronda">
				    			<?php 
					    			while($fila = mysqli_fetch_array($resultadotres))
					    			{

				    			?>
			    			
			    				<option value="<?php echo $fila[0]?>"><?php echo $fila[1]?></option>
			    			<?php
									}
								}else{
									echo "<script type='text/javascript'>alert('Ocurrió un error inesperado');</script>";
									break;
								}
			    			?>
			    			</select>
			    			<?php
			    				$consultatres = "SELECT * FROM country";
								$resultadotres = mysqli_query($conexion, $consultatres);

								if($resultadotres){
			    			?>
			    			<label for="" style="font-size:20px; text-align:left">PAISE 1:</label>
			    			<select name="pais1">
			    				<?php 
					    			while($fila = mysqli_fetch_array($resultadotres))
						    			{
				    				?>
				    				<option value="<?php echo $fila[0]?>"><?php echo $fila[1]?></option>
				    				<?php
										}
									}else{
										echo "<script type='text/javascript'>alert('Ocurrió un error inesperado');</script>";
										break;
									}
								?>
			    			</select>
			    			<?php
			    				$consultatres = "SELECT * FROM country";
								$resultadotres = mysqli_query($conexion, $consultatres);

								if($resultadotres){
			    			?>
			    			<label for="" style="font-size:20px; text-align:left">PAISE 2:</label>
			    			<select name="pais2">
			    				<?php 
					    			while($fila = mysqli_fetch_array($resultadotres))
						    			{
				    				?>
				    				<option value="<?php echo $fila[0]?>"><?php echo $fila[1]?></option>
				    				<?php
										}
									}else{
										echo "<script type='text/javascript'>alert('Ocurrió un error inesperado');</script>";
										break;
									}
								?>
			    			</select>
			    			<input type="text" name="descripcion_ronda" placeholder="Descripcion">
			    			<input type="text" name="estadio" placeholder="Estadio">
			    			<input type="text" name="hora" placeholder="Hora">
			    			<input type="submit" name="agregar" value="Agregar">
			    		</form>
		    		</div>

		    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="panel panel-success">
							<div class="panel-heading">
						    	<h3 class="panel-title"><strong>PAIS-RONDAS - COPA AMERICA</strong></h3>
						  	</div>
				    		<!-- IMPORTANT: IT ALLOWS THE TABLE TO BE RESPONSIVE -->
						  	<div id="source_code_content" class="tab-content">	
								<div id="tbl_container_demo_grid1" class="table-responsive">
									<table id="list" class="table table-bordered table-hover">
										<!-- TABLE HEAD -->
										<thead>
											<tr id="tbl_demo_grid1_tr_0">
												<th class="th-common identificators">
													ID RONDA
												</th>
												<th class="th-common">
													RONDA
												</th>
												<th class="th-common identificators">
													ID COUNTRY 1
												</th>
												<th class="th-common identificators">
													ID COUNTRY 2
												</th>
												<th class="th-common">
													PAIS 1
												</th>
												<th class="th-common">
													PAIS 2
												</th>
												<th class="th-common">
													DESCRIPCION
												</th>
												<th class="th-common">
													ESTADIO
												</th>
												<th class="th-common">
													Hora
												</th>
												<th class="th-common">
													Estado
												</th>
												<th class="th-common">
													Acciones
												</th>
											</tr>
										</thead>
										<!-- FINISH TABLE HEAD -->
										<?php
											$consultatres = "SELECT c.id_round, f.description, c.id_country_one, c.id_country_two, c.description, r.description, c.description, c.stadium, c.hora, c.can_vote FROM country_round c, country r, country t, round f where c.id_round = f.id AND c.id_country_one = r.id AND c.id_country_two = t.id order by id_round";
											$resultadotres = mysqli_query($conexion, $consultatres);

											if($resultadotres){
										?>
										<!-- TABLE BODY -->
										<tbody id="table-body" style="cursor:pointer;">
											<?php
												while($rowtres = mysqli_fetch_array($resultadotres)){
													echo "<tr><td class='identificators'>";
													echo $rowtres[0] . "</td><td>";
													echo $rowtres[1] . "</td><td class='identificators'>";
													echo $rowtres[2] . "</td><td class='identificators'>";
													echo $rowtres[3] . "</td><td>";
													echo $rowtres[4] . "</td><td>";
													echo $rowtres[5] . "</td><td>";
													echo $rowtres[6] . "</td><td>";
													echo $rowtres[7] . "</td><td>";
													echo $rowtres[8] . "</td><td>";
													if($rowtres[9]){
														echo "Abierta</td><td>";
														echo "<form action='php/close_exist_round.php' method='GET'>
															<input class='identificators' type='text' name='roundID' value='" . $rowtres[0] . "'>
															<input class='identificators' type='text' name='country1' value='" . $rowtres[2] . "'>
															<input class='identificators' type='text' name='country2' value='" . $rowtres[3] . "'>
															<input class='btn-change' type='submit' name='close_round' value='Cerrar'>
														</form></td></tr>";
													}else{
														echo "Cerrada</td><td>";
														echo "<form action='php/open_exist_round.php' method='GET'>
															<input class='identificators' type='text' name='roundID' value='" . $rowtres[0] . "'>
															<input class='identificators' type='text' name='country1' value='" . $rowtres[2] . "'>
															<input class='identificators' type='text' name='country2' value='" . $rowtres[3] . "'>
															<input class='btn-change' type='submit' name='close_round' value='Abrir'>
														</form></td></tr>";
													}
													
												}
												
											?>
										</tbody>
										<!-- FINISH TABLE BODY -->
										<?php
											}else{
												echo "<script type='text/javascript'>alert('Ocurrió un error inesperado');</script>";
											}
										?>
									</table>
								</div>
							</div>
							<!-- FINISH TABLE RESPONSIVE -->
						</div>
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
	 include'footer.php'; 
?>