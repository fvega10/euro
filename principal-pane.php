<?php 
	include("php/seguridad.php");
	include'header.php'; 
	include'top-bar.php'; 
	require_once("php/user.php");
	require_once("php/round.php");
	require_once("php/groups.php");
	$username    = $_SESSION["usuarioactual"];
	$usersession = $_SESSION['usuarioname'];
	$point       = $_SESSION['points'];
	$userDataAccess   = new user();
	$roundDataAccess  = new round();
	$groupsDataAccess = new group();
?>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="myModalLabel">
        			<strong>Usuario: </strong> 
					<?php
						if((string)$usersession === ""){
					 		echo $username;
						}else{
							echo $usersession;
						}
					?>
        		</h4>
      	</div>
      	<div class="modal-body">
        	<?php
				echo "<p><strong>Correo electrónico: </strong>" . $username . "</p>";
				echo "<p><strong>Usuario: </strong>" . $usersession . "</p>";
				echo "<p><strong>Puntuación: </strong>" . $point  . "</p>";
        	?>
      	</div>
      	<div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar panel</button>
	        <button id="close_session" type="button" class="btn btn-danger">Cerrar sesión</button>
      	</div>
    </div>
  </div>
</div>

<div class="container-fluid singin">
	<header>
		<nav class="navbar navbar-default">
		  	<div class="container-fluid">
		    	<!-- Brand and toggle get grouped for better mobile display -->
		    	<div class="navbar-header">
		      	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        	<span class="sr-only">Menú</span>
		        	<span class="glyphicon glyphicon-option-vertical" aria-hidden="true"></span>
		        	Menú

		      	</button>
		      	
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      	<ul class="nav navbar-nav">
		        	<li role="presentation" class="active"><a href="#allJourny" aria-controls="allJourny" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-th"></span> Todas las jornadas</a></li>
            		<li role="presentation"><a href="#dayJourny" aria-controls="dayJourny" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-th-large"></span> Jornada del día</a></li>
            		<li role="presentation"><a href="#generalTable" aria-controls="generalTable" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-list-alt"></span> Tabla general <span class="sr-only">(current)</span></a></li>
            		<li role="presentation"><a href="#stadistics" aria-controls="stadistics" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-stats"></span> Estadísticas</a></li>
            		<li role="presentation"><a href="#info" aria-controls="info" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-info-sign"></span> Información general</a></li>
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
	</header>

	<div class="tab-content">
	   	<div role="tabpanel" class="tab-pane" id="generalTable">
	    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="panel panel-info">
					<div class="panel-heading">
				    	<h3 class="panel-title"><strong>TABLA GENERAL DE LA QUINIELA - EUROCOPA</strong></h3>
				  	</div>
				  	<!-- IMPORTANT: IT ALLOWS THE TABLE TO BE RESPONSIVE -->
				  	<div id="source_code_content" class="tab-content">	
						<div id="tbl_container_demo_grid1" class="table-responsive">
							<table id="list" class="table table-bordered table-hover">
								<!-- TABLE HEAD -->
								<thead>
									<tr id="tbl_demo_grid1_tr_0">
										<th class="th-common">
											<span class="glyphicon glyphicon-sort-by-order" aria-hidden="true"></span><br />
											Posic.
										</th>
										<th class="th-common">
											<span class="glyphicon glyphicon-user" aria-hidden="true"></span><br />
											Usuario
										</th>
										<th class="th-common">
											<span class="glyphicon glyphicon-tasks" aria-hidden="true"></span><br />
											Puntaje
										</th>
										<th class="th-common">
											<span class="glyphicon glyphicon-new-window" aria-hidden="true"></span><br />
											Acciones
										</th>
									</tr>
								</thead>
								<!-- FINISH TABLE HEAD -->

								<!-- TABLE BODY -->
								<tbody id="table-body" style="cursor:pointer;">
									<?php
										$array = $userDataAccess->getUsers();
										if($array[0] != '0'){
											$cont = 1;
											foreach($array as $row)
											{
												if($cont === 1){
													echo "<tr class='success'><td>";
												}else{
													echo "<tr><td>";
												}
												echo $cont . "</td><td>";
												echo $row[2] . "</td><td>";
												echo $row[1] . "</td><td>";
												echo "<a class='ver-button' href='profile.php?profile=$row[0]'>Ver perfil</a></td></tr>";
												$cont++;
											}
										}
										else
										{
											echo "Ocurrió un error inesperadamente";
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
		</div>
	 	
	 	<div role="tabpanel" class="tab-pane active" id="allJourny">
	 		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			 	<?php
			 		$array = $roundDataAccess->GetRounds();
			 		if($array[0] != 'error'){
			 			foreach($array as $fila){ //while resultado
				?>			
							<div class="panel panel-default">
						   	 	<div class="panel-heading" role="tab" id="<?php echo 'heading' . $fila[0]; ?>">
						      		<h4 class="panel-title">
							        	<a role="button acordeon" data-toggle="collapse" data-parent="#accordion" href="<?php echo '#tab' . $fila[0]; ?>" aria-expanded="true" aria-controls="collapseOne">
							          		<?php echo $fila[1]; ?>
							        	</a>
						      		</h4>
						    	</div>
						    	<div id="<?php echo 'tab' . $fila[0]; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="<?php echo 'heading' . $fila[0]; ?>">
							      	<div class="panel-body">
						        		<?php
						        			$arregloCountryRound = $roundDataAccess->GetCountryRound($fila[0]);
						        			if($arregloCountryRound[0] != 'error'){
						 						foreach($arregloCountryRound as $filaCountryRound)
						 						{
						 							$ArrayfilaUser = $roundDataAccess->GetResults($username, $fila[0], $filaCountryRound[1], $filaCountryRound[2]);
														if($ArrayfilaUser[0] != 'error'){ //resultadoUser two
															foreach($ArrayfilaUser as $filaUser){
																if($filaUser[0] != NULL){

										?>
																	<div class="col-md-3 votation">
														    			<div class="votation-head">
														    				<p><strong>Partido:</strong> <?php echo $filaCountryRound[7] . " vrs " . $filaCountryRound[8]; ?></p>
														    				<p><strong>Hora:</strong> <?php echo $filaCountryRound[5]; ?></p>
														    				<p><strong>Estadio:</strong> <?php echo $filaCountryRound[4]; ?></p>		
														    			</div>
														    			
														    			<form class="form-inline" action="php/votation-modified.php" method="GET">
														    				<input class="identificators" type="text" name="id_username" value="<?php echo $username ?>" >
														    				<input class="identificators" type="text" name="id_round" value="<?php echo $filaCountryRound[0];?>" >
																		  	<input class="identificators" type="text" name="id_country_one" value="<?php echo $filaCountryRound[1];?>" >
																		  	<input class="identificators" type="text" name="id_country_two" value="<?php echo $filaCountryRound[2];?>" >

																		  	<div class="form-group">
																			    <div class="input-group">
																			      	<div class="input-group-addon"><?php echo $filaCountryRound[7]; ?></div>
															      				<?php
															      					if((boolean)$filaCountryRound[6])
															      					{
															      				?>	
																	      				<input type="number" name="country_one" class="form-control" value="<?php echo $filaUser[0]; ?>" id="exampleInputAmount" min="0" max="99">
																			    
																			    <?php
															      					}
															      					else
															      					{
													      						?>
														      							<input type="number" name="country_one" class="form-control" value="<?php echo $filaUser[0]; ?>" id="exampleInputAmount" min="0" max="99" disabled>
															      				<?php
															      					}
															      				?>
																			    </div>
																		  	</div>
																		  	
																		  	<div class="form-group">
																			    <div class="input-group">
																			      	<div class="input-group-addon"><?php echo $filaCountryRound[8]; ?></div>
																	      		<?php
															      					if((boolean)$filaCountryRound[6])
															      					{
															      				?>	
																	      				<input type="number" name="country_two" class="form-control" value="<?php echo $filaUser[1]; ?>" id="exampleInputAmount" min="0" max="99">
																			    <?php
															      					}
															      					else
															      					{
													      						?>
														      							<input type="number" name="country_two" class="form-control" value="<?php echo $filaUser[1]; ?>" id="exampleInputAmount" min="0" max="99" disabled>
															      				<?php
															      					}
															      				?>
																			    </div>
																		  	</div>

																		  	<?php
														      					if((boolean)$filaCountryRound[6])
														      					{
														      				?>	
																      				<input type="submit" class="btn btn-primary" value="Modificar"></input>
																		    <?php
														      					}
														      					else
														      					{
												      						?>
													      							<p>Votación cerrada</p>
														      				<?php
														      					}
														      				?>
																		</form>
														    		</div>
											<?php					//Modificado y cerrado
																}else{
											?>
																	<div class="col-md-3 votation">
														    			<div class="votation-head">
														    				<p><strong>Partido:</strong> <?php echo $filaCountryRound[7] . " vrs " . $filaCountryRound[8]; ?></p>
														    				<p><strong>Hora:</strong> <?php echo $filaCountryRound[5]; ?></p>
														    				<p><strong>Estadio:</strong> <?php echo $filaCountryRound[4]; ?></p>		
														    			</div>
														    			
														    			<form class="form-inline" action="php/votation.php" method="GET">
														    				<input class="identificators" type="text" name="id_username" value="<?php echo $username ?>" >
														    				<input class="identificators" type="text" name="id_round" value="<?php echo $filaCountryRound[0];?>" >
																		  	<input class="identificators" type="text" name="id_country_one" value="<?php echo $filaCountryRound[1];?>" >
																		  	<input class="identificators" type="text" name="id_country_two" value="<?php echo $filaCountryRound[2];?>" >

																		  	<div class="form-group">
																			    <div class="input-group">
																			      <div class="input-group-addon"><?php echo $filaCountryRound[7]; ?></div>
																	      			<input type="number" name="country_one" class="form-control" placeholder="Marcador aquí" value="" id="exampleInputAmount" min="0" max="99">
																			    </div>
																		  	</div>
																		  	
																		  	<div class="form-group">
																			    <div class="input-group">
																			      <div class="input-group-addon"><?php echo $filaCountryRound[8]; ?></div>
																		      		<input type="number" name="country_two" class="form-control" placeholder="Marcador aquí" value="" id="exampleInputAmount" min="0" max="99">
																			    </div>
																		  	</div>
														  					<input type="submit" class="btn btn-primary" value="Votar"></input>
																		</form>
														    		</div>
										<?php
																}
															}
															
														}else{
															echo 'Ocurrió un error inesperadamente resultados';
															break;	
														}
												}//end while resultadocountryround
											}else{
												echo 'Ocurrió un error inesperadamente country round';	
											}
										?>
							        </div>
						    	</div>
						  	</div>
				<?php
 						}//end while resultado
			 		}else{
						echo 'Ocurrió un error inesperadamente round';
					}
			 	?>
			</div>
	 	</div>
		
	    <div role="tabpanel" class="tab-pane" id="dayJourny">
	    	<?php
	    		$consultaRoundActive = $roundDataAccess->GetRoundActive();
	    		if($consultaRoundActive[0] != 'error'){ //resultado
	    			foreach($consultaRoundActive as $fila)
	    			{ //while resultado	
			?>    			
		    			<h2 style="background: white;color: #999;padding: 10px;"><?php echo $fila[1]?></h2>
			<?php
						$consultaCountryRound = $roundDataAccess->GetCountryRound($fila[0]);
			    		if($consultaCountryRound[0] != 'error'){ //resultadoCountryRound
			    			foreach($consultaCountryRound as $filaCountryRound){ //while resultadoCountryRound
			?>
						    	<div class="col-md-3 votation">
					    			<div class="votation-head">
					    				<p><strong>Partido:</strong> <?php echo $filaCountryRound[7] . " vrs " . $filaCountryRound[8]; ?></p>
					    				<p><strong>Hora:</strong> <?php echo $filaCountryRound[5]; ?></p>
					    				<p><strong>Estadio:</strong> <?php echo $filaCountryRound[4]; ?></p>	
					    			</div>
									<?php
										$consultaUser = $roundDataAccess->GetCountryRound($username, $fila[0], $filaCountryRound[1], $filaCountryRound[2]);
										if($consultaUser[0] != null)
										{ //resultadoUser
											foreach($consultaUser as $filaUser)
											{
												if($filaUser[0] != NULL)
												{ //resultadoUser two
										?>
													<form class="form-inline" action="php/votation.php" method="GET">
														<input class="identificators" type="text" name="id_username" value="<?php echo $username ?>" >
									    				<input class="identificators" type="text" name="id_round" value="<?php echo $fila[0];?>" >
													  	<input class="identificators" type="text" name="id_country_one" value="<?php echo $filaCountryRound[1]; ?>" >
													  	<input class="identificators" type="text" name="id_country_two" value="<?php echo $filaCountryRound[2]; ?>" >

													  	<div class="form-group">
														    <div class="input-group">
														      	<div class="input-group-addon">
														      		<?php echo $filaCountryRound[7]; ?>
														      	</div>
								      	<?php
								      							if((boolean)$filaCountryRound[6])
								      							{
										?>
								      								<input type="number" name="country_one" class="form-control" value="<?php echo $filaUser[0];?>" id="exampleInputAmount" min="0" max="99" required>
								      	<?php
								      							}
								      							else
								      							{
								      	?>
								      								<input type="number" name="country_one" class="form-control" value="<?php echo $filaUser[0];?>" id="exampleInputAmount" min="0" max="99" disabled>
								      	<?php
								      							}
								      	?>
														    </div>
													  	</div>
													  	
													  	<div class="form-group">
														    <div class="input-group">
														      	<div class="input-group-addon">
														      		<?php echo $filaCountryRound[8]; ?>
														      	</div>
								      	<?php
								      							if((boolean)$filaCountryRound[6])
								      							{
										?>
								      								<input type="number" name="country_two" class="form-control" value="<?php echo $filaUser[1];?>" id="exampleInputAmount" min="0" max="99" required>
								      	<?php
								      							}
								      							else
								      							{
								      	?>
								      								<input type="number" name="country_two" class="form-control" value="<?php echo $filaUser[1];?>" id="exampleInputAmount" min="0" max="99" disabled>
								      	<?php
								      							}
								      	?>	
														    </div>
													  	</div>
									  	<?php
						      							if((boolean)$filaCountryRound[6])
						      							{
										?>
						      								<input type="submit" class="btn btn-primary" value="Modificar"></input>
								      	<?php
						      							}
						      							else
						      							{
								      	?>
						      								<p><strong>Votación cerrada</strong></p>
								      	<?php
						      							}
								      	?>	
													</form>
										<?php
												}else{ //end resultadoUser two and begin else resultadoUser two
										?>
													<form class="form-inline" action="php/votation.php" method="GET">
														<input class="identificators" type="text" name="id_username" value="<?php echo $username ?>" >
									    				<input class="identificators" type="text" name="id_round" value="<?php echo $fila[0];?>" >
													  	<input class="identificators" type="text" name="id_country_one" value="<?php echo $filaCountryRound[1]; ?>" >
													  	<input class="identificators" type="text" name="id_country_two" value="<?php echo $filaCountryRound[2]; ?>" >

													  	<div class="form-group">
														    <div class="input-group">
														      	<div class="input-group-addon">
														      		<?php echo $filaCountryRound[7]; ?>
														      	</div>
											      				<input type="number" name="country_one" class="form-control" placeholder="Marcador aquí" value="" id="exampleInputAmount" min="0" max="99" required>
														    </div>
													  	</div>
													  	
													  	<div class="form-group">
														    <div class="input-group">
														      	<div class="input-group-addon">
														      		<?php echo $filaCountryRound[8]; ?>
														      	</div>
													      		<input type="number" name="country_two" class="form-control" placeholder="Marcador aquí" value="" id="exampleInputAmount" min="0" max="99" required>
														    </div>
													  	</div>
									  					<input type="submit" class="btn btn-primary" value="Votar"></input>
													</form>
				<?php
												}//end else resultadoUser two
											}
										}
										else
										{
										break;
										}//resultadoUser
			?>
					    		</div>
			<?php
							}//end while resultadoCountryRound
						}
						else
						{
						break;
						}//end resultadoCountryRound
	    			}//end while resultado
	    		}
	    		else
	    		{
	    		break;
	    		}//end resultado
	    	?>	 
		</div>

	    <div role="tabpanel" class="tab-pane" id="stadistics">
	    	<?php
	    		$consulta = $groupsDataAccess->GetGroups();
				if($consulta[0] != 'error')
				{
					foreach($consulta as $fila)
					{
			?>
						<div class="col-md-6 reducir-panel">
							<div class="panel panel-info">
								<div class="panel-heading">
							    	<h3 class="panel-title"><strong><?php echo $fila[1]?></strong></h3>
							  	</div>
							  	<!-- IMPORTANT: IT ALLOWS THE TABLE TO BE RESPONSIVE -->
							  	<div id="source_code_content" class="tab-content">	
									<div id="tbl_container_demo_grid1" class="table-responsive">
										<table id="list" class="table table-bordered table-hover">
											<!-- TABLE HEAD -->
											<thead>
												<tr id="tbl_demo_grid1_tr_0">
													<th class="th-common">
														Equipo
													</th>
													<th class="th-common">
														PJ
													</th>
													<th class="th-common">
														G
													</th>
													<th class="th-common">
														E
													</th>
													<th class="th-common">
														P
													</th>
													<th class="th-common">
														GF
													</th>
													<th class="th-common">
														GC
													</th>
													<th class="th-common">
														Ptos.
													</th>
												</tr>
											</thead>
											<!-- FINISH TABLE HEAD -->
											<?php
												$var = "<script>window.print(screen.width)</script>";
												$consultaCountryGroup = $groupsDataAccess->GetCountryGroups($fila[0]); 
												if($consultaCountryGroup[0] != 'error'){
											?>
													<tbody id="table-body" style="cursor:pointer;">
											<?php
													foreach($consultaCountryGroup as $filaCountryGroup)
													{
														echo "<tr><td class='alinear'>";
														if($var > 980){
															echo "<span class='icono $filaCountryGroup[10]'></span>" . $filaCountryGroup[9] . "</td><td>";
														}else{
															echo "<span class='icono $filaCountryGroup[10]'></span>" . $filaCountryGroup[10] . "</td><td>";
														}
														
														echo $filaCountryGroup[2] . "</td><td>";
														echo $filaCountryGroup[3] . "</td><td>";
														echo $filaCountryGroup[4] . "</td><td>";
														echo $filaCountryGroup[5] . "</td><td>";
														echo $filaCountryGroup[6] . "</td><td>";
														echo $filaCountryGroup[7] . "</td><td>";
														echo $filaCountryGroup[8] . "</td></tr>";
													}
											?>
													</tbody> <!-- FINISH TABLE BODY -->
											<?php
												}
											?>
										</table>
									</div>
								</div>
								<!-- FINISH TABLE RESPONSIVE -->
							</div>
			    		</div>
			<?php
					}
				}
				else
				{
					echo 'Ocurrió un error inesperadamente';
				}
			?>

    		<div class="col-md-12">
				<div class="panel panel-info">
					<div class="panel-heading">
				    	<h3 class="panel-title"><strong>Jornadas realizadas - EUROCOPA</strong></h3>
				  	</div>
				  	<!-- IMPORTANT: IT ALLOWS THE TABLE TO BE RESPONSIVE -->
				  	<div id="source_code_content" class="tab-content">	
						<div id="tbl_container_demo_grid1" class="table-responsive">
							<table id="list" class="table table-bordered table-hover">
								<!-- TABLE HEAD -->
								<thead>
									<tr id="tbl_demo_grid1_tr_0">
										<th class="th-common">
											Votación
										</th>
										<th class="th-common">
											Resultado correcto
										</th>
										<th class="th-common">
											Puntos obtenidos
										</th>
									</tr>
								</thead>

							<?php
								$oldResults = $groupsDataAccess->GetResults($username);
								if($oldResults != 'error')
								{
							?>	
									<!-- TABLE BODY -->
									<tbody id="table-body" style="cursor:pointer;">
									<?php
										$total = 0;
										
										foreach($oldResults as $row){
											$totalGeneral = 0;
											if($row[4] != NULL && $row[8] != NULL){
												if($row[3] === $row[4] && $row[7] === $row[8]){
													echo "<tr class='success'><td>";
												}else{
													if( (integer)$row[3] > (integer)$row[7] && (integer)$row[4] > (integer)$row[8] )
													{
														echo "<tr class='warning'><td>";
													}
													else if( (integer)$row[3] < (integer)$row[7] && (integer)$row[4] < (integer)$row[8] )
													{
														echo "<tr class='warning'><td>";
													}
													else if( (integer)$row[3] === (integer)$row[7] && (integer)$row[4] === (integer)$row[8] )
													{
														echo "<tr class='warning'><td>";
													}else{
														echo "<tr class='danger'><td>";
													}
													
												}
												echo $row[2] . ": " . $row[3] . " vrs " . $row[6] . ": " . $row[7] . "</td><td>";
												echo $row[2] . ": " . $row[4] . " vrs " . $row[6] . ": " . $row[8] . "</td><td>";
												if($row[3] === $row[4] && $row[7] === $row[8])
												{
													$totalGeneral = 5;
													$total += 5;
												}else{
													if( (integer)$row[3] > (integer)$row[7] && (integer)$row[4] > (integer)$row[8] )
													{
														$totalGeneral = 2;
														$total += 2;
													}
													if( (integer)$row[3] < (integer)$row[7] && (integer)$row[4] < (integer)$row[8] )
													{
														$totalGeneral = 2;
														$total += 2;
													}
													if( (integer)$row[3] === (integer)$row[7] && (integer)$row[4] === (integer)$row[8] )
													{
														$totalGeneral = 2;
														$total += 2;
													}
												}
												echo $totalGeneral . "</td></tr>";
											}
										}//end while cycle
										echo "<tr><td>";
										echo "</td><td>";
										echo "<strong>PUNTUACIÓN TOTAL:</strong> </td><td>";
										echo "<strong>" . $total . "</strong></td></tr>";
									?>
									</tbody>
									<!-- FINISH TABLE BODY -->
							<?php
								}
								else
								{
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

	    <div role="tabpanel" class="tab-pane" id="info">
	    	<div class="col-md-12">
    			<div class="row">
    				<h2 style="background: white;color: #999;padding: 10px;">¿COMO JUGAR?</h2>
    				<h5 align="justify"><span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span> Las rondas cierran justo antes de iniciar el encuentro.</h5>
    				<h5 align="justify"><span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span> Por acertar el ganador del encuentro además del marcador gana un total de: <strong style="color:yellow">5 PUNTOS</strong></h5>
    				<h5 align="justify"><span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span> Por acertar el gane de un equipo o el empate de un encuentro, sin acertar marcadores gana un total de: <strong style="color:yellow">2 PUNTOS</strong></h5>
    				<h5 align="justify"><span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span> Debe digitar el marcador que usted cree es el correcto y presionar el botón votar, así sucesivamente por cada encuentro</h5>
    				<h5 align="justify"><span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span> Si la ronda no ha sido cerrada usted tendrá la opción de modificar su marcador</h5>
    			</div>
    		</div>
	    </div>
	</div>
</div>

<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  	<!-- Indicators -->
  	<ol class="carousel-indicators">
    	<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    	<li data-target="#carousel-example-generic" data-slide-to="1"></li>
  	</ol>

  	<!-- Wrapper for slides -->
  	<div class="carousel-inner" role="listbox">
    	<div class="item active">
      		<img src="img/reemplazo.jpg" alt="..." width="50%">
      		<div class="carousel-caption">
        		<h2><a href="notice2.php">¿Qué dicen las normas sobre sustituir jugadores lesionados en esta UEFA EURO 2016?</a></h2>
        		<hr />
        		<p>
        			Si un jugador convocado se lesiona de gravedad o enferma antes del primer partido en la fase final de su selección, 
        			puede ser sustituido solo si un doctor del Comité Médico de la UEFA<a href="notice2.php">[...]</a>
        		</p>
      		</div>
    	</div>
    	<div class="item">
      		<img src="img/cesc.jpg" alt="..." width="50%">
      		<div class="carousel-caption">
       		 	<h2><a href="notice1.php">Cesc Fàbregas</a></h2>
       		 	<hr />
        		<p>
        			Cesc Fàbregas vivirá en la 
       		 		EURO 2016 su tercera fase final en una 
       		 		gran campeonato de Europa, y de momento solo ha 
       		 		saboreado el éxito del triunfo tras <a href="notice1.php">[....]</a>
        		</p>
      		</div>
		</div>
	</div>

  <!-- Controls -->
  	<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    	<span class="sr-only">Anterior</span>
  	</a>
  	<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
   	 	<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    	<span class="sr-only">Siguiente</span>
  	</a>
</div>
<?php include'footer.php'; ?>