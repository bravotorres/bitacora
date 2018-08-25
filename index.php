<?php
date_default_timezone_set('Mexico/General');
?>
<!DOCTYPE html>
<html>
<html lang="es">
<head>
    <meta charset=utf-8>
    <meta name=viewport content="width=device-width, initial-scale=1">
    <title>Inicio de sesión</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body class="bgimage2">
<div class="container">

    <form role="form" method="POST">
        <h1>Inicio de sesión</h1>
        <div class="form-grop">
            <label for="user"><h3>Correo electrónico:</h3></label>

            <input width="100%" class="form-control" id="name" name="name" placeholder="Correo Electronico" type="text" required >
            <br>
            <label ><h3>Contraseña:</h3></label>
            <input class="form-control" id="pass" name="pass" placeholder="Password" type="password" required>
            <br>

            <button type="submit" name="entrada" id="entrada" class="btn btn-success btn-lg">
                Entrada
            </button>

            <button type="sumbit" name="salida" id="salida" class="btn btn-danger btn-lg" >
                Salida
            </button>

        </div>
    </form>

    <div>
        <?php
        if (isset($_POST['entrada'])) {
            $email = $_POST['name'];
            $pass = $_POST['pass'];

            print("$email -> $email");
            print("$pass -> $pass");

            include("util.php");

            $ctaUsuario = "SELECT date(now()) as fhoy, now() as ahora,  idusuarios, username, password FROM usuarios where  idstatus = 1 AND email='$email' AND password='$pass'";
            $result=$conn->query($ctaUsuario);
            $rows=$result->num_rows;

            if ($rows==1){
                for ($i=0; $i <$rows ; $i++) {
                    $result->data_seek($i);
                    $row=$result->fetch_array(MYSQLI_ASSOC);
                    $datenow=$row['fhoy'];
                    $datetimenow=$row['ahora'];
                    $idusuario=$row['idusuarios'];
                    $name=$row['username'];
                }

                $ctaRegistro="SELECT date(horadeentrada) as fentrada, horadeentrada, horadesalida FROM registro where idusuarios='$idusuario' and date(horadeentrada)=date(now())";
                $result=$conn->query($ctaRegistro);
                $rows=$result->num_rows;

                if ($rows>0) {
                    for ($i=0; $i <$rows ; $i++) {
                        $result->data_seek($i);
                        $row=$result->fetch_array(MYSQLI_ASSOC);
                        $date=$row['fentrada'];
                        $datetime=$row['horadeentrada'];
                    }
                    print("<br><div class='alert alert-danger font' role='alert'>Buen dia $name su hora  de entrada ya habia sido registrada: $datetime </div>");
                }else{
                    $inserRegistro="INSERT INTO registro VALUES(0,'$idusuario', NOW(), 'null', 'null','null')";
                    $result=$conn->query($inserRegistro);
                    print("<br><div class='alert alert-success font' role='alert'>Buen dia $name su hora  de entrada se ha registrado: $datetimenow  ,<a href='deletesession.php'> <b>has click aqui para continuar</b></a></div>");
                }

            }else{
                print("<br><div class='alert alert-danger' role='alert'>Sus datos no coinciden</div>");
            }
            $conn->close();
        }

        if (isset($_POST['salida'])) {

            $email=$_POST['name'];
            $pass=$_POST['pass'];
            include("util.php");

            $ctaUsuario= "SELECT date(now()) as fhoy, now()  as ahora,  idusuarios, username, password FROM usuarios where  idstatus = 1 AND email='$email' AND password='$pass'";
            $result=$conn->query($ctaUsuario);
            $rows=$result->num_rows;

            if ($rows>0) {

                session_start();
                $_SESSION['eMail']=$email;
                $_SESSION['Pass']=$pass;
                for ($i=0; $i <$rows ; $i++) {
                    $result->data_seek($i);
                    $row=$result->fetch_array(MYSQLI_ASSOC);
                    $datenow=$row['fhoy'];
                    $datetimenow=$row['ahora'];
                    $idusuario=$row['idusuarios'];
                    $name=$row['username'];
                }
                $ctaRegistro="SELECT date(horadeentrada) as fentrada, idregistro, horadeentrada, horadesalida FROM registro where idusuarios='$idusuario' and date(horadeentrada)=date(now())";
                $result=$conn->query($ctaRegistro);
                $rows=$result->num_rows;


                if ($rows>0) {
                    for ($i=0; $i <$rows ; $i++) {
                        $result->data_seek($i);
                        $row=$result->fetch_array(MYSQLI_ASSOC);
                        $date=$row['fentrada'];
                        $datetime=$row['horadeentrada'];
                        $datetimeS=$row['horadesalida'];
                        $idregistro=$row['idregistro'];

                    }
                    if ($datetimeS=='0000-00-00 00:00:00') {
                        header("Location: registro.php");
                    }else{
                        print("<br><div class='alert alert-danger font' role='alert'>Buen dia $name su hora de salida ya habia sido registrada: $datetimeS </div>");
                    }
                }else{
                    print("<br><div class='alert alert-danger font' role='alert'>Buen dia $name su hora  de entrada no ha sido registrada porfavor registrela para poder registrar su salida</div>");
                }
            }else{
                print("<br><div class='alert alert-danger' role='alert'>Sus datods no coinciden</div>");
            }
        }
        ?>
    </div>
    <br>
    <div>
        <a class="btn btn-default btn-lg" href="creacionUsuario.php">
                <span class="glyphicon glyphicon-user" aria-hidden="true">
                    <br>Crea usuario
                </span>
        </a>
        <a class="btn btn-default btn-lg" href="loginAdmin.php">
                <span class="glyphicon glyphicon-queen" aria-hidden="true">
                    <br>Administrador
                </span>
        </a>
    </div>
</div>
</body>
</html>