<?php

  session_start();

  if (isset($_SESSION['id_user'])) {
    header('Location: registrousuario.php');
  }
  include('funciones.php');
  $conexion=conexionBD();

  if(!empty($_POST['name_login']) && !empty($_POST['pass_login'])){
    $name_login=$_REQUEST['name_login'];
    $pass_login=$_REQUEST['pass_login'];
    $sql="SELECT `idSubir`, `email`, `password` FROM `subir` WHERE `email`='$name_login'";
    $result=mysqli_query($conexion,$sql);
    $mostrar=mysqli_fetch_array($result);
    if($mostrar['email']==$name_login && password_verify($pass_login, $mostrar['password'])){
      $_SESSION['id_user']=$mostrar['idSubir'];
      header('Location: registrousuario.php');
      exit();
    }else{
      $error[]='Usuario o Contraseña incorrecta';
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Login page</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="css/estilos.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </head>
  <body>
  <?php
    if(!empty($error)){
      foreach($error as $dato) {
        echo '<div>'.$dato.'</div><br>';
      }
    }
  ?>
    <div class="login-box">
      <img src="img/myprogram.png" class="avatar" alt="Avatar Image">
      <h1>Inicio de sesion</h1>
      <form action="index.php" method="POST">
        <!-- USERNAME INPUT -->
        <label for="username">Usuario</label>
        <input name="name_login" type="email" placeholder="Ingresa el usuario">
        <!-- PASSWORD INPUT -->
        <label for="password">Contraseña</label>
        <input name="pass_login" type="password" placeholder="Ingresa la contraseña">
        <input type="submit" value="iniciar secion">
        <a href="signup.php">¿No tienes cuenta?</a>
      </form>
    </div>
  </body>
</html>