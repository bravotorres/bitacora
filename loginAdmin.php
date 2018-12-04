<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name=viewport content="width=device-width, initial-scale=1">

    <title>Bitácora - Login Admin</title>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <link rel="icon" href="images/ipn.png">
    <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="css/loginAdmin.css" rel="stylesheet" id="bootstrap-csss">

</head>
<body id="LoginAdmin">
    <div class="container">
        <!-- Panel de Administrador ...-->

        <!-- Inicio de Sesión -->
        <div class="login-form">
            <div class="main-div">
                <div class="panel">
                    <h2>Inicio de sesión Administrador</h2>
                    <p>Ingrese sus datos de acceso.</p>
                </div>
                <form role="form" method="POST">
                    <div class="form-grop">
                        <label for="name">
                            E-mail de Administrador:
                        </label>
                        <input width="100%" class="form-control" id="name" name="name" placeholder="Correo electrónico" type="text" required >
                        <br>

                        <label for="pass">
                            Contraseña:
                        </label>
                        <input class="form-control" id="pass" name="pass" placeholder="Contraseña" type="password" required>

                        <br>
                        <button type="submit" name="entrada" id="entrada" class="btn btn-success btn-lg">
                            Entrada
                        </button>
                    </div>
                </form>
                <?php
                include("util.php");

                if (isset($_POST['entrada'])) {
                    $email = $_POST{'name'};
                    $pass = $_POST['pass'];

                // $ctaUsuario = "SELECT idusuarios, alias, username, email, password FROM usuarios where  idusuarios=1 AND email='$email' AND password='$pass'";
                    $ctaUsuario = "SELECT id, username, email, password FROM usuarios where id=1 AND email='$email' AND password='$pass'";
                    print("<br><br><br><div class='alert alert-warning' role='alert'>$ctaUsuario</div>");

                    $result = $conn->query($ctaUsuario);
                    $rows = $result->num_rows;

                    if ($rows==1){
                        session_start();
                        $_SESSION['eMail'] = $email;
                        $_SESSION['Pass'] = $pass;
                        header('Location: panelAdmin.php');
                    }
                    else{
                        print("<br><br><br><div class='alert alert-warning' role='alert'>Su correo electrónico o contraseña son invalidos.</div>");
                    }
                    $result->close();
                    $conn->close();
                }
                ?>
                <br/>
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
        </div>
    </div>
    
    <div class="container">
        <form role="form" method="POST">
            <h1>Inicio de sesión</h1>
            <div class="form-grop">
                <label for="name">
                    E-mail de Administrador:
                </label>
                <input width="100%" class="form-control" id="name" name="name" placeholder="Correo electrónico" type="text" required >
                <br>
                <label for="pass">Cotnraseña:</label>
                <input class="form-control" id="pass" name="pass" placeholder="Contraseña" type="password" required>
                <br>
                <button type="submit" name="entrada" id="entrada" class="btn btn-success btn-lg">Entrada</button>
            </div>
        </form>
        <div class="col-md-6"></div>
        <div class="col-md-6">
            
        </div>
        <div class="col-md-6"></div>
        <div class="col-md-6">
            <br><br><br>
            <a class="btn btn-default btn-lg" href="index.php">
                <span class="glyphicon glyphicon-home" aria-hidden="true"><br>Home</a>
                    <a class="btn btn-default btn-lg" href="creacionUsuario.php"><span class="glyphicon glyphicon-user" aria-hidden="true"><br>Crea usuario</a>
                    </div>
                </div>
            </body>
            </html>