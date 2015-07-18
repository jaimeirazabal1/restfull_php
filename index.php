<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('form').submit(function(e){
				e.preventDefault();
				este = $(this);
				$.ajax({
					dataType:"JSON",
					url:"usuario.php",
					type:este.attr("method"),
					data:$(this).serialize(),
					success:function(r){
						console.log(r)
						alert(r)
					}
				})
			})
		})
	</script>
	<title>RestFull</title>
</head>
<body>
	<fieldset>
		<legend>GET</legend>
		<form action="" method="GET">
			<input type="submit" value="GET" name="peticion">
		</form>
	</fieldset>
	<fieldset>
		<legend>POST</legend>
		<form action="" method="POST">
			<input type="submit" value="POST" name="peticion">
		</form>
	</fieldset>
	<fieldset>
		<legend>PUT</legend>
		<form action="" method="PUT">
			<input type="text" value="" name="nombre" placeholder="Nombre">
			<input type="text" value="" name="apellido" placeholder="Apellido">
			<input type="date" value="" name="fecha_nacimiento" placeholder="Fecha">
			<input type="submit" value="PUT" name="peticion">
		</form>
	</fieldset>
	<fieldset>
		<legend>DELETE</legend>
		<form action="" method="DELETE">
			<input type="submit" value="DELETE" name="peticion">
		</form>
	</fieldset>
</body>
</html>