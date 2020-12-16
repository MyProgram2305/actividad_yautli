<?php
  session_start();

  session_unset();

  session_destroy();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Logout page</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="css/estilos.css">
  </head>
  <body>
    <div>
      <h1>GRACIAS POR VISITARNOS</h1> 
   </div>
   <a href="index.php" class="btn">
      Inica sesion <i class="fas fa-chevron-right"></i>
    </a><br><br>
    <a href="signup.php" class="btn">
      Registrate <i class="fas fa-chevron-right"></i>
    </a>
  </body>
</html>