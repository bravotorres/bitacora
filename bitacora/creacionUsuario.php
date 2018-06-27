
<!DOCTYPE html>
<html>
<html lang="es">
<head>
    <style type="text/css">
    .bgimage2{
        background-image: url("images/bg2.jpg"); 
        background-repeat: no-repeat;
        background-size: 100%  200%; 
    }
    .noresize{
        resize: none;
    }
</style>
<meta charset="utf-8" />
<script type="text/javascript">
    function reset(){
        document.getElementsByTagName("form").reset();
    }
</script>
<br>
<br>
<br>
<title>Creacion de usuario</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body class="bgimage2" onload="reset()"> 
    <div class="container">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-8">
                <form action="creacionUsuario.php" role="form" id="form" name="form" method="POST" >
                    <h1> <b>Creación de usuario</b></h1>
                    <hr>
                    <label >Nombre:<br>
                        <input class="form-control" id="name" name="name" placeholder="Nombre" type="text" required>
                    </label>
                    <label >Apellido Paterno:<br>
                        <input class="form-control" id="aPaterno" name="aPaterno" placeholder="Apellido paterno" type="text" required>
                    </label>
                    <label >Apellido Materno:<br>
                        <input class="form-control" id="aMaterno" name="aMaterno" placeholder="Apellido materno" type="text" required>
                    </label>
                    <br>
                    <label >Email:<br>
                        <input class="form-control" id="email" name="email" placeholder="E-mail" type="email" required>
                    </label>
                    <label >Alias:<br>
                        <input class="form-control" id="alias" name="alias" placeholder="Alias" type="text" required>
                    </label>
                    <br>
                    <h2><b>Contraseña</b></h2>
                    <hr>
                    <label >Cotnraseña:<br>
                        <input class="form-control" id="pass" name="pass" placeholder="Contraseña" type="password" required>
                    </label>
                    <label >Confirma:<br>
                        <input class="form-control" id="conpass" name="conpass" placeholder="Confirmar contraseña" type="password" required>
                    </label>
                    <br><br><br>
                    <button type="submit" onclick="" class="btn btn-primary btn-lg" id="crear" name="crear">Crear</button>
                </form>  
                <br>
                <div>           
                    <br>
                    <?php 
                    if (isset($_POST['crear'])) {
                        $name=$_POST['name'];
                        $aPaterno=$_POST['aPaterno'];
                        $aMaterno=$_POST['aMaterno'];
                        $email=$_POST['email'];
                        $alias=$_POST['alias'];
                        $pass=$_POST['pass'];
                        $conpass=$_POST['conpass'];
                        if(empty($email) &&  empty($nombre)){
                            print("<div class='alert alert-danger' role='alert'>Error campos vacios...</div>");
                        }else{
                            if ($pass==$conpass) {
                                include("util.php");
                                $ctaUsuario= "SELECT idusuarios, username, apaterno, amaterno, amaterno FROM usuarios where username='$name";
                                $inserUsuario="INSERT INTO usuarios VALUES(0, '$alias', '$name', '$aPaterno', '$aMaterno', '$pass', '$email', 2)";
                                $resultado=$conn->query($inserUsuario);
                                if (!$resultado) {
                                    die("Acceso denegado".$conn->error);
                                } else {

                                    mysqli_close($conn);
                                    print("<div class='alert alert-warning' role='alert'><a href='index.php'>Registro exitoso presione aqui para Terminar</a></div>");
// print("<button type='button' href='Login.php' class='btn btn-warning btn-lg'>Terminar</button>");
//header("Location: creacionUsuario.php");
                                }
                            }else {
                                print("<div class='alert alert-success' role='alert'>La contraseña no coincide verifique...</div>");
                            }  
                        }      

                    }
                    ?>           
                </div>
                <br>
                <div>
                    <a class="btn btn-default btn-lg" href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"><br>Home</a>
                        <a class="btn btn-default btn-lg" href="loginAdmin.php"><span class="glyphicon glyphicon-queen" aria-hidden="true"><br>Administrador</a>
                        </div>
                    </div>
                </div>
            </div>

        </body>
        </html>