<!DOCTYPE html>
<?php 
session_start(); 
date_default_timezone_set('Mexico/General');
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <title>Inicio de sesión</title>

    <title>Bitácora - Registro de Asistencia</title>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <link rel="icon" href="images/ipn.png">
    <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="css/registro.css" rel="stylesheet" id="bootstrap-csss">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body id="LoginForm"> 
    <div class="container">
        <!-- Panel central -->
        <div class="login-form">
            <div class="main-div">
                <div class="panel">
                    <h2>Registro de asistencia.</h2>
                    <!-- <p>Para generar el registro, ingrese su información.</p> -->
                </div>
                <form id="Login" role="form" action="" method="POST">
                    <!-- Campo: Número de Máquina -->
                    <div class="form-group">
                        <label>Máquina:</label>
                        <input type="number" class="form-control" id="mchine" name="machine" min="1" max="10" required>
                    </div>

                    <div class="form-group">
                        <label>Comentarios:</label>
                        <textarea class="form-control noresize" name="comment" id="comment" rows="3"></textarea>
                    </div>

                    <button type="submit" name="registrar" class="btn btn-success btn-lg">
                        Registrar
                    </button>
                    
                    <button type="reset"  class="btn btn-danger btn-lg" >
                        Limpiar
                    </button>
                </form>


                    <!-- <div class="container"> -->
                        <!-- <div class="form-grop">
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
                        </div> -->
                        <div>
                            <?php
                            
                            include("util.php");

                            if (isset($_SESSION['eMail']) and isset($_SESSION['Pass'])) {
                                $email = $_SESSION['eMail'];
                                $pass = $_SESSION['Pass'];
                                
                                $ctaUsuario = "SELECT us.id, us.username, us.email, us.password, re.id as idregistro, now() as ahora  
                                    FROM registro re 
                                    inner join usuarios us 
                                    on us.id = re.id_usuarios 
                                    where us.email='$email' and us.password='$pass' and date(re.hora_entrada)=date(now())";

                                $result = $conn->query($ctaUsuario);
                                $rows = $result->num_rows;
                                
                                print("<br><div class='alert alert-success font' role='alert'> >> $ctaUsuario <br> $rows</div>");

                                for ($i=0; $i < $rows; $i++) { 
                                    $result->data_seek($i);
                                    $row = $result->fetch_array(MYSQLI_ASSOC);
                                    
                                    $idusuario = $row['id'];
                                    $name = $row['username'];
                                    $idregistro = $row['idregistro'];
                                    $datetimenow = $row['ahora'];
                                }
                                
                                if (isset($_POST['registrar'])) {
                                    $machine = $_POST['machine'];
                                    $comment = $_POST['comment'];
                                    $update = "UPDATE registro SET 
                                        hora_salida=now(), 
                                        maquina='$machine', 
                                        comentario='$comment' 
                                        WHERE id='$idregistro' and date(hora_entrada)=date(now())";

                                    $result = $conn->query($update);
                                    print("<br><div class='alert alert-success font' role='alert'>Buen dia $name su hora  de salida se ha registrado: $datetimenow  ,<a href='deletesession.php'> <b>has click aqui para terminar</b></a></div>");
                                }

                            }else{
                                header("Location: index.php");
                            }
                            ?>
                        </div>
                        <!-- </div> -->
                </div></div>
            </div>
        </body>
        </html>
