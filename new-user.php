<?php include'header.php'; ?>

<div class="container-fluid">
	<div class="row singin">
		<img src="logo.png" alt="">
		<form action="php/create-new-user.php" method="POST">
			<input id="emailNew" name="email" type="email" placeholder="Digite el correo electrónico" required>
			<input id="UserNew" name="userNombre" type="text" placeholder="Digite el nombre de usuario" required>
			<input id="PasswordNew" name="password" type="password" placeholder="Digite la contraseña" required>
			<input id="RePasswordNew" name="repassword" type="password" placeholder="Verifique su contraseña" required>
			<input type="button" onclick="insert();" value="Crear usuario">
		</form>
	</div>
</div>

<?php include'footer.php'; ?>
	