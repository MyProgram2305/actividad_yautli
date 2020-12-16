<?php

  include('funciones.php');
  $conexion=conexionBD();
  if(empty($_POST['email'])){ 
	$errores[]="No has escrito el correo electronico."; 
	$email=NULL;
  }else{
	$email=$_REQUEST['email'];
	  $sql="SELECT idSubir FROM subir WHERE email='$email'";
	  $stmt = $conexion->prepare($sql);
	  if($sql==$email){
		 $errores[]="Ese correo electronico ya se ha registrado. Favor de escribir otro"; 
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
	$password = password_hash($_POST['pass'], PASSWORD_BCRYPT);
	}
	if(empty($errores)){ // Si no hay errores, se guardará la info
		$sql = "INSERT INTO `subir`(`email`, `password`) VALUES ('$email','$password');";
		if(mysqli_query($conexion,$sql)){ // Si los datos son guardados.
			echo 'se pudo guardar exitosamente';
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
    <title>SignUp page</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="css/estilos.css">
  </head>
  <body>
	<?php 	
	if(!empty($errores)){
		foreach($errores as $dato) {
			echo '<div">'.$dato.'</div><br>';
		}
	}
	?>

    <div class="login-box">
      <img src="img/myprogram.png" class="avatar" alt="Avatar Image">
      <h1>Registrate</h1>
      <form action="signup.php" method="POST">
        <!-- USERNAME INPUT -->
      <label for="username">Usuario</label>
      <input name="email" type="text" placeholder="Ingresa el usuario">
        <!-- PASSWORD INPUT -->
      <label for="pass">Contraseña</label>
      <input name="pass" type="password" placeholder="Ingresa una contraseña">
      <input name="passConfirmado" type="password" placeholder="Confirma tu contraseña">
      <input type="submit" value="Registrarse">
      <a href="index.php">Regresar al inicio</a>
      <a href="logout.php">salir</a>
    </form>
    </div>
  </body>
</html>