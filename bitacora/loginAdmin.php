
.<!DOCTYPE html>
<html>
<html lang="es">
<head>
 <style type="text/css">
   .bgimage2{
     background-image: url("images/bg4.jpg"); 
     background-repeat: no-repeat;
      
   }
   .noresize{
     resize: none;
   }
   .font{
    font-size: 150% 
   }
 </style>
 <meta charset="utf-8" />
 <title>Administrador</title>
 <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body class="bgimage2"> 
  <br><br>
  <div class="container"> 
    <form role="form" method="POST">
      <h1>Inicio de sesión</h1>   
      <div class="form-grop">
        <label for="user">E-mail de Administrador:</label>
         <input width="100%" class="form-control" id="name" name="name" placeholder="User name" type="text" required >
        <br>
        <label >Cotnraseña:</label>
         <input class="form-control" id="pass" name="pass" placeholder="pass" type="password" required>
         <br>
         <button type="submit" name="entrada" id="entrada" class="btn btn-success btn-lg">Entrada</button>
      </div>
    </form>
    <div class="col-md-6"></div>
    <div class="col-md-6">
<?php


       if (isset($_POST['entrada'])) {
          $email=$_POST{'name'};
          $pass=$_POST['pass'];
          include("util.php");
          $ctaUsuario= "SELECT idusuarios, alias, username, email, password FROM usuarios where  idusuarios = 1 AND email='$email' AND password='$pass'";
           
          $result=$conn->query($ctaUsuario);
          $rows=$result->num_rows;
          if ($rows==1){
            session_start();
            $_SESSION['eMail']=$email;
            $_SESSION['Pass']=$pass;
            header('Location: bitacora.php');
          }
          else{
            print("<br><br><br><div class='alert alert-warning' role='alert'>El correo ó contraseña son invalid@s </div>"); 
          }
           $result->close();
           $conn->close();
        }  
      ?>
    </div>
    <div class="col-md-6"></div>
    <div class="col-md-6">
        <br><br><br>
      <a class="btn btn-default btn-lg" href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"><br>Home</a>
      <a class="btn btn-default btn-lg" href="creacionUsuario.php"><span class="glyphicon glyphicon-user" aria-hidden="true"><br>Crea usuario</a>
    </div>
  </div>

</body>
</html>