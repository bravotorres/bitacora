<?php
session_start();
if (isset($_SESSION['eMail']) and isset($_SESSION['Pass'])) {
	


  ?>
<!DOCTYPE html>
<html>
<html lang="es">
<head>
 <style type="text/css">
   .bg{
     background-image: url("images/bg5.jpg"); 
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
   }
 </style>
 <meta charset="utf-8" />
 <title>Bitacora</title>
 <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body  class="bg">
<?php

include "util.php";
$conn->query("SET NAMES 'utf8'"); 
?>

	<div class="container">
	<form name="form" id="form" method="POST" action="bitacora.php">
	<br><br><br>

		<div class="row">
		  <div class="col-md-4"></div>
		  <div class="col-md-4"><h1>Bitacora de registro</h1></div>
		  <div class="col-md-4">.</div>
		  
		</div>
		<div class="row">
			<br><br><br>
			<div class="col-md-4">
		  		
		    </div>
		  	<div class="col-md-4">
		  		<label>Buscar usuario:</label>
		  		<select name="usuario" id="usuario">
		  			
<?php

                $consulta="SELECT UPPER(idusuarios) idusuarios, UPPER(username) username, UPPER(apaterno) apaterno, UPPER(amaterno) amaterno FROM usuarios where idusuarios>1 ORDER BY username ASC";
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
		    	 <button class="btn btn-primary btn-lg" type="submit" name="busca" id="busca">Buscar registro</button>
		    </div>
		</div>
	</form>	
		<br><br><br>
		
<?php
	

		
		if (isset($_POST['busca'])) {
			$idusuario=$_POST['usuario'];
			print("
					<table class='table table-striped'>
						<tr>
								<td class='bo'>#</td>
								<td class='bo'>Hora de entrada</td>
								<td class='bo'>Hora de salida</td>
								<td class='bo'>Maquina</td>
								<td class='bo'>Comentario</td>
						</tr>
				");
			$ctaRegistro="SELECT * FROM registro where idusuarios='$idusuario'";
			 $res=$conn->query($ctaRegistro) or die (mysql_error ());
            	$rows=$res->num_rows; 
             	
             	if ($rows>0) {
             	           	
	              	for($j=0 ; $j < $rows ; ++$j){
	              		$res->data_seek($j);
	              		$row=$res->fetch_array(MYSQLI_ASSOC);
	              		$idregistro = $row['idregistro'];
	              		$iduser = $row['idusuarios'];
	              		$entrada = $row['horadeentrada'];
	              		$salida = $row['horadesalida'];
	              		$maquina = $row['maquina'];
	              		$comentario = $row['comentario'];
		              	print("
		              		<tr>
								<td class='bo'>$j</td>
								<td>$entrada</td>
								<td>$salida</td>
								<td>$maquina</td>
								<td>$comentario</td>
							</tr>
							
						");

              		}
                	$res->close(); 	
                }else{

					print("</table> <div class='alert alert-warning'>No existe registro de bitacora....</div> ");
				}
		}
?>
						</table>
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