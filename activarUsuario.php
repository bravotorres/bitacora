<?php
// session_start();
// if (isset($_SESSION['eMail']) and isset($_SESSION['Pass'])) {
	


  ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>...::ACTIVAR USUARIO::...</title>
	<style type="text/css">
	   .bg{
	     background-image: url("images/bg6.jpg"); 
	     background-repeat: no-repeat;
	     background-size: 100%  200%; 
	   }
	   .noresize{
	     resize: none;
	   }
	   .font{
	    font-size: 150% 
	   }
	   .bo{
	   	font-weight: bold;
	   	font-size: 3em;
	   }
	 </style>
	 <meta charset="utf-8" />
	 <link rel="icon" href="images/ipn.png">
	 <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body class="bg">
<?php
include("util.php");
$conn->query("SET NAMES 'utf8'"); 
?>
	
	<div class="container">
	<form action="activarUsuario.php" method="POST" name="form" id="form">
	<br><br><br> 
		<div class="row">
			<div class="col-md-12"><h1 class="bo">Activación de usuario</h1><br><br><br></div>

			<div class="col-md-4">
		  		<label>Buscar usuario:</label>
		  		<select name="usuario" id="usuario">
		  		<option>Elige un usuario.</option>	
<?php

                $consulta="SELECT UPPER(idusuarios) idusuarios, UPPER(username) username, UPPER(apaterno) apaterno, UPPER(amaterno) amaterno FROM usuarios where idstatus=2 ORDER BY username ASC";
                $res=$conn->query($consulta) or die (mysql_error ());
             	
             	$filas=$res->num_rows;
             	
              	for($j=0 ; $j < $filas ; ++$j){
              		$res->data_seek($j);
              		$fila=$res->fetch_array(MYSQLI_ASSOC);
              		$id = $fila['idusuarios'];
              		$nombre = $fila['username'];
              		$apaterno = $fila['apaterno'];
              		$amaterno = $fila['amaterno'];
              		print("<option id='' value='".$id."'>".$nombre." ".$apaterno." ".$amaterno."</option>");
              	}
                                       
?>
		  		</select>
		  	</div>
		    <div class="col-md-4">
		    	 <button class="btn btn-primary btn-lg" type="submit" name="busca" id="busca">Activar Usuario</button>
		    	 <br><br><br>
		    </div>

		</div>
	</form>

<?php
		if (isset($_POST['busca'])) {
			$idusuario=$_POST['usuario'];
			$actualiza="UPDATE usuarios SET	idstatus=1 WHERE idusuarios='$idusuario'";
			
			$result=$conn->query($actualiza);
			if ($result=1) {
				print("<div class='alert alert-success'>Usuario Activado....</div> ");
			}
			else{

				print("<div class='alert alert-warning'>No hay usuario por activar....</div> ");
			}

				
				
		}
?>	
	
		<div>
		<br><br><br>
		  <a class="btn btn-default btn-lg" href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"><br>Home</a>
	      <a class="btn btn-default btn-lg" href="activarUsuario.php"><span class="glyphicon glyphicon-user" aria-hidden="true"><br>Activar usuario</a>
	      <a class="btn btn-default btn-lg" href="loginAdmin.php"><span class="glyphicon glyphicon-queen" aria-hidden="true"><br>Administrador</a>
	      <a class="btn btn-default btn-lg" href="deletesession.php"><span class="glyphicon glyphicon-off" aria-hidden="true"><br>Cerrar Sesión</a>
	    </div>
    </div>
<?php 
}else{
	header("Location:index.php");
}

?>
</body>
</html>