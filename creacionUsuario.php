<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name=viewport content="width=device-width, initial-scale=1">

    <title>Bitácora - Creación de usuario</title>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <link rel="icon" href="images/ipn.png">
    <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="css/creacionUsuario.css" rel="stylesheet" id="bootstrap-csss">

</head>
<body id="creacionUsuario">
<div class="container">
    <!-- Panel de Administrador ...-->

    <!-- Inicio de Sesión -->
    <div class="login-form">
        <div class="main-div">
            <div class="panel">
                <form action="creacionUsuario.php" role="form" id="form" name="form" method="POST" >
                    <h1> <b>Creación de usuario</b></h1>
                    <hr>
                    <label >Nombre:<br>
                        <input class="form-control" id="name" name="name" placeholder="Nombre" type="text" required>
                    </label>
                    <div class="form-group">
                        <label >Apellido Paterno:<br>
                            <input class="form-control" id="aPaterno" name="aPaterno" placeholder="Apellido paterno" type="text" required>
                        </label>
                        <label >Apellido Materno:<br>
                            <input class="form-control" id="aMaterno" name="aMaterno" placeholder="Apellido materno" type="text" required>
                        </label>
                    </div>
                    <br>
                    <label >Email:<br>
                        <input class="form-control" id="email" name="email" placeholder="E-mail" type="email" required>
                    </label>
                    <!--                    <label >Alias:<br>-->
                    <!--                        <input class="form-control" id="alias" name="alias" placeholder="Alias" type="text" required>-->
                    <!--                    </label>-->
                    <br>
<!--                    <h2><b>Contraseña</b></h2>-->
                    <hr>
                    <label >Contraseña:<br>
                        <input class="form-control" id="pass" name="pass" placeholder="Contraseña" type="password" required>
                    </label>
                    <label >Confirma:<br>
                        <input class="form-control" id="conpass" name="conpass" placeholder="Confirmar contraseña" type="password" required>
                    </label>
                    <br><br><br>
                    <button type="submit" onclick="" class="btn btn-primary btn-lg" id="crear" name="crear">Crear</button>
                </form>

                <br>

                <div class="btn-group">
                    <a class="btn btn-default btn-lg" href="index.php">
                        <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                        <br>Home
                    </a>
                    <a class="btn btn-default btn-lg" href="loginAdmin.php">
                        <span class="glyphicon glyphicon-queen" aria-hidden="true"></span>
                        <br> Administrador
                    </a>
                </div>



            </div>
        </div>
    </div>
</div>


</body>
</html>