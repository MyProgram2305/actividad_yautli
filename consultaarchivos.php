<?php 
   session_start(); 
	include('funciones.php');
	$conexion=conexionBD();
	if(empty($_SESSION['id_user'])){
		 header('location: index.php');
		 exit(); 
	}
	
	if (!empty($_REQUEST['eliminar']) && $_REQUEST['eliminar']=='si'){
		$sql="DELETE FROM archivos WHERE id=". $_REQUEST['id'];
		mysqli_query($conexion,$sql);
	}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	 <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link href="navbar-top-fixed.css" rel="stylesheet">
		<link rel="stylesheet" href="css/estilos.css">
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<title>Consulta de Archivos</title>
 </head>
 <body>
 	<?php barraMenu(); ?>	
 		<br><br><br><br><br><br>
		 <center>
		 <h1>Consulta de Archivos</h1>
 	<div class="container">
 		<table class="table table-striped table-dark">
 			<thead>
	 			<tr>
	 				<th scope="col">Nombre de Archvio</th>
	 				<th scope="col">Fecha Modificacion</th>
	 				<th></th>
	 			</tr>
 			</thead>
 				<tbody>
				<?php   
				$sql="SELECT * FROM `archivos` WHERE `activo`='1'";
				$result=mysqli_query($conexion,$sql);
				while ($mostrar=mysqli_fetch_array($result)) {
				?>
				<tr>
					<td><?php echo $mostrar['nombreArchivo']; ?></td>
					<td><?php echo $mostrar['fmodificacion']; ?></td>
					<td><a href="<?php echo 'uploads/'.  $mostrar['nombreArchivo'];?>" target="_new" class="btn btn-sm btn-primary btn-block">ver</a></td>
					<td><a href="<?php echo 'consultaarchivos.php?eliminar=si&id='. $mostrar['id']; ?>" class="btn btn-sm  btn-danger btn-block">eliminar</a></td>
				</tr>
 					<?php } ?>
 				</tbody>
 		</table>
 	</div>
		 </center>
 </body>
</html>