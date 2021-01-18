<!DOCTYPE html>
<html>
<head>
	<title>Registro</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="librerias/bootstrap4/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="librerias/jquery-ui-1.12.1/jquery-ui.theme.css">
    <link rel="stylesheet" type="text/css" href="librerias/jquery-ui-1.12.1/jquery-ui.css">
</head>
<body background="img/fo2.jpg">
	<div class="container">
		<br>
		<br>
		<h1 style="text-align:center;"><b>Registro de usuario</b></h1>
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<form id="frmRegistro" method="post" onsubmit="return agregarUsuarioNuevo()" autocomplete="off">
					<label style="color: black;"> <b>Nombre personal</b></label>
					<input type="text" name="nombre" id="nombre" class="form-control" required="">
					<label style="color: black;"><b>Fecha de nacimiento</b></label>
					<input type="text" name="fechaNacimiento" id="fechaNacimiento" class="form-control" required="" readonly="">
					<label style="color: black;"><b>Email</b></label>
					<input type="email" name="correo" id="correo" class="form-control" required="">
					<label style="color: black;"><b>Nombre de usuario</b></label>
					<input type="text" name="usuario" id="usuario" class="form-control" required="">
					<label style="color: black;"><b>Contraseña</b></label>
					<input type="password" name="password" id="password" class="form-control" required="">
					<br>
					<div class="row">
						<div class="col-sm-6 text-left">
							<button class="btn btn-primary">Registrar</button>
						</div>
						<div class="col-sm-6 text-right">
							<a href="index.php" class="btn btn-success">Login</a>
						</div>
					</div>
				</form>
			</div>
			<div class="col-sm-4"></div>
		</div>		
	</div>
	<script src="librerias/jquery-3.5.1.min.js"></script>
	<script src="librerias/jquery-ui-1.12.1/jquery-ui.js"></script>
	<script src="librerias/sweetalert.min.js"></script>

	<script type="text/javascript">

		$(function()
		{
			var fechaA = new Date();
			var yyyy = fechaA.getFullYear();

			$('#fechaNacimiento').datepicker(
			{
				changeMonth: true,
				changeYear: true,
				yearRange: "1900:" + yyyy,
				dateFormat: "dd-mm-yy"
			});
		});

		function agregarUsuarioNuevo()
		{
			$.ajax({
				method: "POST",
				data: $('#frmRegistro').serialize(),
				url: "procesos/usuario/registro/agregarUsuario.php",
				success:function(respuesta)
				{
					respuesta = respuesta.trim();
					if(respuesta == 1)
					{
						$('#frmRegistro')[0].reset();
						swal(":D", "Agregado con exito!", "success");
					}
					else if (respuesta == 2) 
					{
						swal("Este usuario ya existe, por favor escribe otro!!!");
					}
					else
					{
						swal(":D", " Agregado con exito !", "success");
					}
				}
			});

			return false;
		}
	</script>
</body>
</html>