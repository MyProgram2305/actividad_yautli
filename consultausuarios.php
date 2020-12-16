<?php 
   session_start(); 
	include('funciones.php');
	if(empty($_SESSION['id_user'])){
		header('location: Inicio.php'); 
		exit(); 
	}
	$conexion=conexionBD();
	if (!empty($_REQUEST['eliminar']) && $_REQUEST['eliminar']=='si') {
		$sql="DELETE FROM usuarios WHERE idUsuario=". $_REQUEST['id'];
		mysqli_query($conexion,$sql);
	}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="Bootstrap-4.0.0-dist/css/bootstrap.css">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

 	<title >Consulta de Usuarios</title>
 </head>
 <body>
 	<?php barraMenu(); ?>
 		<br><br><br><br><br>
		 <center>
		 <h1 >Consulta de Usuarios</h1>
 	<div class="container">
 		<table class="table table-striped table-dark">
 			<thead>
	 			<tr>
	 				<th scope="col">Nombres</th>
	 				
	 			</tr>
 			</thead>
 				<tbody>
				<?php 	
					$sql="SELECT * FROM `usuarios` WHERE `activo`='1'";
					$result=mysqli_query($conexion,$sql);
					while ($mostrar=mysqli_fetch_array($result)) {
				?>
				<tr>
					<td><?php echo $mostrar['nombre']; echo " "; echo $mostrar['nombre2']; ?></td>
					<td><a href="<?php echo 'modificarusuario.php?modifica=si&id='.$mostrar['idUsuario']; ?>" class="btn btn-sm  btn-info btn-block">modificar</a></td>
					<td><a href="<?php echo 'detallesusuario.php?detalles=si&id='.$mostrar['idUsuario']; ?>" class="btn btn-sm  btn-secondary btn-block">detalles</a></td>
					<td><a href="<?php echo 'consultausuarios.php?eliminar=si&id='.$mostrar['idUsuario']; ?>" class="btn btn-sm  btn-danger btn-block">eliminar</a></td>
				</tr>
 					<?php } ?>
 				</tbody>
 		</table>
 	</div>
		 </center>
 </body>
 </html>