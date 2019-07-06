<!DOCTYPE html>
<?php
date_default_timezone_set('Mexico/General');
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name=viewport content="width=device-width, initial-scale=1">

    <title>Bitácora - Login</title>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <link rel="icon" href="images/ipn.png">
    <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="css/login.css" rel="stylesheet" id="bootstrap-csss">

</head>
<body id="LoginForm">
    <div class="container">
        <!-- Panel de Administrador ...-->

        <!-- Inicio de Sesión -->
        <div class="login-form">
            <div class="main-div">
                <div class="panel">
                    <h1>Inicio de sesión</h1>
                    <p>Para generar el registro, ingrese su información.</p>
                </div>

                <!--Formulario: Autenticación-->
                <form id="Login" action="" method="POST">
                    <!--Input: Correo electrónico-->
                    <div class="form-group">
                        <input type="email" class="form-control" id="inputEmail" name="name" placeholder="Correo Eletctrónico">
                    </div>

                    <!--Input: Contraseña-->
                    <div class="form-group">
                        <input type="password" class="form-control" id="inputPassword" name="pass" placeholder="Contraseña.">
                    </div>
                    <br>

                    <!--Enlace: Contraseña Olvidada...-->
                    <!-- <div class="forgot">
                        <a href="#">¿Olvidó su contraseña?</a>
                    </div> -->

                    <!--Botón: Iniciar Sesión-->
                    <button type="submit" name="entrada" id="entrada" class="btn btn-success btn-lg btn-block">
                        Entrada
                    </button>

                    <button type="sumbit" name="salida" id="salida" class="btn btn-danger btn-lg btn-block" >
                        Salida
                    </button>
                </form>
                <br>
                
                <?php
                // Conexión a Base de Datos
                include("util.php");
                
                if (isset($_POST['entrada'])) {
                    $email = $_POST['name'];
                    $pass = $_POST['pass'];

                    $ctaUsuario = "SELECT date(now()) as fhoy, now() as ahora,  id, username, password FROM usuarios where  id_status=1 AND email='$email' AND password='$pass'";
                    echo $ctaUsuario;

                    $result = $conn->query($ctaUsuario);  // FIXME
                    print("<h1>result: ".$result."</h1>");
                    $rows = $result->num_rows;

                    print("<h1>rows: ".$rows."</h1>");

                    if ($rows == 1){
                        for ($i=0; $i < $rows ; $i++) {
                            $result->data_seek($i);
                            $row = $result->fetch_array(MYSQLI_ASSOC);
                            $datenow = $row['fhoy'];
                            $datetimenow = $row['ahora'];
                            $idusuario = $row['id'];
                            $name = $row['username'];
                        }

                        $ctaRegistro="SELECT date(hora_entrada) as fentrada, hora_entrada, hora_salida FROM registro where id_usuarios='$idusuario' and date(hora_entrada)=date(now())";
                        
                        $result=$conn->query($ctaRegistro);
                        $rows=$result->num_rows;

                        if ($rows > 0) {
                            for ($i=0; $i <$rows ; $i++) {
                                $result->data_seek($i);
                                $row = $result->fetch_array(MYSQLI_ASSOC);
                                $date = $row['fentrada'];
                                $datetime = $row['hora_entrada'];
                            }
                            print("<br><div class='alert alert-danger font' role='alert'>Buen dia $name, su hora de entrada ya habia sido registrada: $datetime </div>");
                        }else{
                            $inserRegistro = "INSERT INTO registro (id_usuarios, hora_entrada, hora_salida, maquina, comentario) VALUES ('$idusuario', NOW(), '0001-01-01 00:00:00', 0, '')";
                            
                            $result = $conn->query($inserRegistro);
                            print("<br><div class='alert alert-success font' role='alert'>Buen dia $name, su hora  de entrada se ha registrado: $datetimenow  ,<a href='deletesession.php'> <b>has click aqui para continuar</b></a></div>");
                        }

                    }else{
                        print("<br><div class='alert alert-danger' role='alert'>Verifique los campos, sus datos no coinciden</div>");
                    }
                    $conn->close();
                }

                if (isset($_POST['salida'])) {
                    // include("util.php");

                    $email = $_POST['name'];
                    $pass = $_POST['pass'];

                    $ctaUsuario = "SELECT date(now()) as fhoy, now()  as ahora, id, username, password FROM usuarios where  id_status = 1 AND email='$email' AND password='$pass'";
                    
                    $result = $conn->query($ctaUsuario);
                    $rows = $result->num_rows;

                    if ($rows > 0) {

                        session_start();
                        
                        $_SESSION['eMail'] = $email;
                        $_SESSION['Pass'] = $pass;
                        
                        for ($i=0; $i < $rows; $i++) {
                            $result->data_seek($i);
                            $row = $result->fetch_array(MYSQLI_ASSOC);
                            $datenow = $row['fhoy'];
                            $datetimenow = $row['ahora'];
                            $idusuario = $row['id'];
                            $name = $row['username'];
                        }

                        $ctaRegistro = "SELECT date(hora_entrada) as fentrada, id, hora_entrada, hora_salida FROM registro where id_usuarios='$idusuario' and date(hora_entrada)=date(now())";
                        
                        $result = $conn->query($ctaRegistro);
                        $rows = $result->num_rows;
                        
                        if ($rows > 0) {
                            for ($i = 0; $i < $rows; $i++) {
                                $result->data_seek($i);
                                $row = $result->fetch_array(MYSQLI_ASSOC);
                                $date = $row['fentrada'];
                                $idregistro = $row['id'];
                                $datetime = $row['hora_entrada'];
                                $datetimeS = $row['hora_salida'];
                            }

                            if($datetimeS == '0001-01-01 00:00:00') {
                                // Redirección a la pagina de registro de bitacora
                                header("Location: /registro.php");
                            }else{
                                print("<br><div class='alert alert-danger font' role='alert'>Buen dia $name, su hora de salida ya habia sido registrada: $datetimeS </div>");
                            }
                        }else{
                            print("<br><div class='alert alert-danger font' role='alert'>Buen dia $name, su hora de entrada no ha sido registrada porfavor registrela para poder registrar su salida</div>");
                        }
                    }else{
                        print("<br><div class='alert alert-danger' role='alert'>Sus datos no coinciden</div>");
                    }
                }
                ?>
                <br>
                
                <div class="btn-group">
                    <a class="btn btn-default btn-lg" href="creacionUsuario.php">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        <br>Crear Usuario
                    </a>
                    <a class="btn btn-default btn-lg" href="loginAdmin.php">
                        <span class="glyphicon glyphicon-queen" aria-hidden="true"></span>
                        <br> Administrador
                    </a>
                </div>
        </div>

        <!--<p class="botto-text"> Designed by Sunil Rajput</p>-->
        <p class="botto-text">IPN - ESCOM [2018]</p>
    </div>
</div>

</body>
</html>
