<?php
function barraMenu(){
  ?>

  <div class="div-nav">
  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="index.php">Inicio</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Archivos</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="subirarchivos.php">Subir archivos</a>
          <a class="dropdown-item" href="consultaarchivos.php">Consultar archivos</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Usuarios</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="registrousuario.php">registro usuario</a>
          <a class="dropdown-item" href="consultausuarios.php">Consultar usuarios</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Cerrar session <span class="sr-only">(current)</span></a>
      </li>
    </ul>
  </div>
</nav>

  </div>
<br>
<?php
}
// ****************
function conexionBD(){
   if(!$conexion= mysqli_connect('localhost','root','','tienda')){
      $errores[]="No fue posible conectar con la BD";
    }
    if($conexion){ return $conexion; }else{ return false; } exit();
}


?>
