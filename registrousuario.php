<?php
  session_start();
  if (empty($_SESSION['id_user'])) {
    header('Location: signup.php');
  }
  include('funciones.php');
  $conexion=conexionBD();

  if(empty($_POST['nombre'])){ 
	$errores[]="No has escrito el nombre."; 
	$nombre=NULL;
  }else{
	  $nombre=$_REQUEST['nombre'];
	  $segundoNombre=$_REQUEST['segundoNombre'];
	}
  if(empty($_POST['apellidoPaterno'])){ 
	  $errores[]="Debes escribir el apellido paterno."; 
	  $apellidoPaterno=Null;
  }else{
	$apellidoPaterno=$_REQUEST['apellidoPaterno'];
  }
  if(empty($_POST['apellidoMaterno'])){ 
	$errores[]="Debes escribir el apellido materno."; 
	$apellidoMaterno=NULL;
	}else{
  		$apellidoMaterno=$_REQUEST['apellidoMaterno'];
	}
  if(empty($_POST['fechaCumpleanios'])){ 
	$errores[]="La fecha de cumplea&ntilde;os es obligatoria."; 
	$fechaCumpleanios=NULL;
  }else{
	$fechaCumpleanios=$_REQUEST['fechaCumpleanios'];
  }
  if(empty($_POST['email'])){ 
	$errores[]="No has escrito el correo electronico."; 
	$email=NULL;
  }else{
	$email=$_REQUEST['email'];
	$sql="SELECT idUsuario FROM usuarios WHERE email='$email' AND activo='1'";
	$stmt = $conexion->prepare($sql);
	if($sql==$email){
		$errores[]="Ese correo electronico ya se ha registrado. Favor de escribir otro"; 
	}
  }
	if(empty($_POST['usuario'])){ 
	  $errores[]="No has escrito el usuario."; 
	  $usuario=NULL;
	}else{
		$usuario=$_REQUEST['usuario'];
		$sql="SELECT idUsuario FROM usuarios WHERE usuario='$usuario' AND activo='1';";
		$stmt =mysqli_query($conexion,$sql);
		$arregloDatos=mysqli_fetch_assoc($stmt);
	  if(!empty($arregloDatos)){ 
		  $errores[]="Ya existe una persona con el mismo usuario. Por favor escriba otro."; 
		}
	}
  if(empty($_POST['pass'])){ 
	  $errores[]="No has escrito la contrase&ntilde;a."; 
	  $pass=NULL;
	}else{
		$pass=$_REQUEST['pass'];
	}
  if(empty($_POST['passConfirmado'])){ 
	  $errores[]="Debe confirmar la contrase&ntilde;a.";
	  $passConfirmado=NULL;
	}else{
		$passConfirmado=$_REQUEST['passConfirmado'];
	}
	if($passConfirmado!= $pass){ 
	  $errores[]="Las contrase&ntilde;as no coinciden.";
	}else{
	$password = password_hash($pass, PASSWORD_BCRYPT);
	}
	if(empty($errores)){ // Si no hay errores, se guardará la info
		$sql = "INSERT INTO `usuarios`(`nombre`, `nombre2`, `apellidoPaterno`, `apellidoMaterno`, `email`, `usuario`, `pass`, `fecha`,`activo`) VALUES ('$nombre','$segundoNombre','$apellidoPaterno','$apellidoMaterno','$email','$usuario','$password','$fechaCumpleanios','1');";
		if(mysqli_query($conexion,$sql)){ // Si los datos son guardados.
			echo '<br><br>'.'<div class="alert alert-primary" role="alert">Se guardo excitosamente </div>';
		}else{
			$errores[]='no se pudo guardar los datos en la base';
		}
	}else{
		$errores[]='hay algun error';
	}	
?>
<!DOCTYPE html>
<html>
	<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Registro de usuarios</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link href="navbar-top-fixed.css" rel="stylesheet">
		<link rel="stylesheet" href="css/estilos.css">
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> 
</head>
	<body> 
	 <?php barraMenu(); ?>	
		<br><br>
			<h1 align="center">Registro de usuarios</h1>
			<form action="registrousuario.php" method="POST" target="_self">
					<input type="hidden" name="siguientePaso" value="2">
					<div class="container">
						<div class="row">
							<div class="col-2">Nombre:</div>
							<div class="col-4">
								<input class="form-control" type="text" name="nombre" placeholder="Nombre de usuario" >
							</div>
							<div class="col-2">Segundo Nombre:</div>
							<div class="col-4">
								<input class="form-control" type="text" name="segundoNombre" placeholder="Segundo nombre">
							</div>
						</div>
						<div class="row">
							<div class="col-2">Apellido Paterno:</div>
							<div class="col-4">
								<input class="form-control" type="text" name="apellidoPaterno" placeholder="Apellido paterno" >
							</div>
							<div class="col-2">Apellido Materno:</div>
							<div class="col-4">
								<input class="form-control" type="text" name="apellidoMaterno" placeholder="Apellido materno">
							</div>
						</div>
						<div class="row">
							<div class="col-2">Fecha de cumplea&ntilde;os:</div>
							<div class="col-4">
								<input class="form-control" type="date" name="fechaCumpleanios" >
							</div>
							<div class="col-2">Correo electr&oacute;nico:</div>
							<div class="col-4">
								<input class="form-control" type="email" name="email" placeholder="Correo electr&oacute;nico">
							</div>
						</div>
						<div class="row">
							<div class="col-2">Usuario:</div>
							<div class="col-2">
								<input class="form-control" type="text" name="usuario" placeholder="Usuario">
							</div>
							<div class="col-2">Contrase&ntilde;a:</div>
							<div class="col-2">
								<input class="form-control" type="password" name="pass">
							</div>
							<div class="col-2">Confirmar contrase&ntilde;a:</div>
							<div class="col-2">
								<input class="form-control" type="password" name="passConfirmado">
							</div>
						</div>
						<div class="row">
							<div class="col-4">
								<input id="btn" type="submit" class="btn btn-primary" value="registrar"></input>
							</div>
						</div>
						<?php
			if(!empty($errores)){
				foreach($errores as $dato){
					echo '<div class="alert alert-danger" role="alert">'.$dato.'</div>';
				}
			}
		?>
					</div>
				</form>
				<br>

		<script src="js/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="js/bootstrap.bundle.min.js"></script>
	</body>
</html>