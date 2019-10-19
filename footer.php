	<div class="container-fluid footer">
		<div class="row">
			<h5>Diseño por: <a href="http://innotecweb.com" target="_blank" style="cursor:pointer">Innovation Technology</a></h5>
		</div>
	</div>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
	<script>
		
		function login(){
			var email = $('#email').val();
			var password = $('#password').val();
			if(email != '' && password != ''){
				$.ajax({
					url:'controllers/user.php',
					type:'POST',
					data:'email='+email+'&password='+password+"&button=singin"
				}).done(function(message){
					
					if(message === 'incorrecto'){
						$('#incorrectUser').show();
					}else{
						location.href = 'principal-pane.php';
					}
				});
			}else{
				$('#inputsRequiredSingin').show();
			}
		}

		function insert(){
			var email = $('#emailNew').val();
			var name = $('#UserNew').val();
			var password = $('#PasswordNew').val();
			var repassword = $('#RePasswordNew').val();

			if(email != '' && name != '' && password != '' && repassword != '')
			{
				if(password === repassword)
				{
					$.ajax({
						url:'controllers/user.php',
						type:'POST',
						data:'email='+email+'&name='+name+'&password='+password+'&button=insert'
					}).done(function(message){
						if(message === 'exito')
						{
							$('#exito').show();
						}
						else if(message === 'aviso')
						{
							$('#aviso').show();
						}
						else
						{
							$('#error').show();
						}
					});
				}
				else
				{
					$('#samePassword').show();
				}
			}
			else
			{
				$('#inputsRequired').show();
			}
		}
	</script>
</body>
</html>