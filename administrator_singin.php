<?php include'header.php'; ?>
<div class="container-fluid">
	<div class="row singin">
		<img src="logo.png" alt="">
		<form action="php/validation_administrator.php" method="POST">
			<input name="password" type="password" placeholder="Ingrese su contraseña" required>
			<input type="submit" value="Ingresar">
		</form>
		<li><a href="new-user.php">Soy nuevo</a></li>
	</div>
</div>
<?php include'footer.php'; ?>