<?php
  session_start();
  if (empty($_SESSION['id_user'])) {
    header('Location: signup.php');
  }
  include('funciones.php');
  if(!empty($_FILES['miarchivo']['name'])){
      if($_FILES['miarchivo']['size']<5000000){
          $extension=explode('.',$_FILES['miarchivo']['name']);
          $nuevoNombre=date('ymdhis').rand(11,99).  '.'  .$extension[1];
          if(move_uploaded_file($_FILES['miarchivo']['tmp_name'], 'uploads/'.$nuevoNombre)){
            $conexion=conexionBD();
            $sentenciaSQL="INSERT INTO `archivos`(`nombreArchivo`,`activo`) VALUES ('$nuevoNombre','1')";
            if(mysqli_query($conexion,$sentenciaSQL)){ // Si logra guardar los datos en la BD
                $correcto="<div class='alert alert-primary' role='alert'>
                Se guardo correctamente <a href='uploads/$nuevoNombre' target='_blank'>Clic para abrir archivo</a>.</div>";
            }else{ $error[]="El archivo se guardó pero no fue posible guardar la información en la BD"; }
          }else{ $error[]="No fue posible guardar el archivo."; }
      }else{ $error[]="El archivo es mas grande que lo permitido. Solo archivos menores a 5Mb."; }
  }
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Subir Archivos</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link href="navbar-top-fixed.css" rel="stylesheet">
	<link rel="stylesheet" href="css/estilos.css">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</head>
<body>  
	<?php 	
	if(!empty($error)){
		foreach($error as $wrong) {
			echo '<div>'.$wrong.'</div><br>';
		}
  }
  if (!empty($correcto)) {
    echo  $correcto;
  }

	?>
  <?php barraMenu(); ?>
  <br><br><br>
  <div class="container">
  <h1 align="center">Subir Archivos</h1>
	<form align="center" action="subirarchivos.php" method="POST" target="_self" enctype="multipart/form-data">
		<label for="miarchivo">Selecciona un archivo (max 5mb)</label>
        <input type="file" name="miarchivo"> <br> <br>
		<input type="submit" class="btn btn-primary btn-lg btn-block" value="Enviar Archivo">
	</form>
  </div>
</body>
</html>