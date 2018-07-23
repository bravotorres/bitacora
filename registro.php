<?php 
session_start(); 
date_default_timezone_set('Mexico/General');
?>
<!DOCTYPE html>
<html>
<html lang="es">
<head>
 <style type="text/css">
   .bgimage2{
     background-image: url("images/bg3.jpg");
     background-repeat: no-repeat;
     background-size: 100%  200%; 
  }
   .noresize{
     resize: none;
   }
 </style>
 <meta charset="utf-8" />
 <br>
 <br>
 <br>
 <title>Registro de asistencia
 </title>
 <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body class="bgimage2"> 
 <form role="form" method="POST">
  <div class="container">
    <h1>Registro de asistencia</h1>   
    <br><br>
    <div class="form-grop">
      <br>
      <label>Máquina:</label>
       <input class="form-control" name="machine" id="mchine" placeholder="numero de maquina" type="number" min="1" max="10" required>
      <br>
       <label>Comentarios:</label>
      <textarea class="form-control noresize" name="comment" id="comment" rows="3"></textarea>
      <br>
      <br>
       <button type="submit" name="registrar" class="btn btn-success btn-lg">Registrar</button>
       <button type="reset"  class="btn btn-danger btn-lg" >Limpiar</button>
    </div>
    <div>
<?php
      
      if (isset($_SESSION['eMail']) and isset($_SESSION['Pass'])) {
        $email=$_SESSION['eMail'];
        $pass=$_SESSION['Pass'];
        include("util.php");
        $ctaUsuario= "SELECT us.idusuarios, us.username, us.email, us.password, re.idregistro, now() as ahora  
                    FROM registro re 
                      inner join usuarios us 
                        on us.idusuarios = re.idusuarios 
                    where us.email='$email' and us.password='$pass' and date(re.horadeentrada)=date(now())";          
        $result=$conn->query($ctaUsuario);
        $rows=$result->num_rows;
        for ($i=0; $i <$rows ; $i++) { 
          $result->data_seek($i);
          $row=$result->fetch_array(MYSQLI_ASSOC);
          $idusuario=$row['idusuarios'];
          $name=$row['username'];
          $idregistro=$row['idregistro'];
          $datetimenow=$row['ahora'];
        }  
        if (isset($_POST['registrar'])) {
          $machine=$_POST['machine'];
          $comment=$_POST['comment'];
          $update="UPDATE registro SET horadesalida=now(), maquina='$machine', comentario='$comment' WHERE idregistro ='$idregistro' and date(horadeentrada)=date(now())";
          $result=$conn->query($update);
          print("<br><div class='alert alert-success font' role='alert'>Buen dia $name su hora  de salida se ha registrado: $datetimenow  ,<a href='deletesession.php'> <b>has click aqui para terminar</b></a></div>");
        }

      }else{
        header("location: index.php");
      }
?>
    </div>
  </div>
 </form>
</body>
</html>