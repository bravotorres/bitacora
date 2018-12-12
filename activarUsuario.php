<!DOCTYPE html>
<?php
session_start();
date_default_timezone_set('Mexico/General');
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name=viewport content="width=device-width, initial-scale=1">

    <title>Bitácora - Administrador</title>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/panelAdmin.js"></script>

    <link rel="icon" href="images/ipn.png">
    <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="css/panelAdmin.css" rel="stylesheet" id="bootstrap-csss">
</head>
<body id="PanelAdmin">
<div class="container">
    <!-- Panel central -->
    <div class="login-form">
        <div class="main-div">
            <div class="panel">
                <h1>Activación de Ususarios.</h1>
            </div>

            <form action="" method="POST" name="form" id="form">
                <div class="row">
                    <div class="form-group">

                        <label for="usuario">Seleccione un usuario para activar: </label>
                        <select name="usuario" id="usuario">
                            <option>Seleccione Usuario</option>
                            <?php
                            include ("util.php");
                            $consulta = "SELECT 
                                  UPPER(id) idusuarios, 
                                  UPPER(nombre) nombre, 
                                  UPPER(primer_apellido) apaterno, 
                                  UPPER(segundo_apellido) amaterno 
                                FROM usuarios where id_status=2 ORDER BY idusuarios ASC";

                            $res = $conn->query($consulta);
                            $filas = $res->num_rows;

                            for ($j=0; $j<$filas; ++$j) {
                                $res->data_seek($j);
                                $fila = $res->fetch_array(MYSQLI_ASSOC);
                                $id = $fila['idusuarios'];
                                $nombre = $fila['nombre'];
                                $apaterno = $fila['apaterno'];
                                $amaterno = $fila['amaterno'];
                                print("<option id='' value='".$id."'>".$apaterno." ".$amaterno.", ".$nombre."</option>");
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" name="busca" id="busca">
                            Activar Usuario
                        </button>
                    </div>
                </div>

            </form>

            <?php
            if (isset($_POST['busca'])) {
                $idusuario = $_POST['usuario'];
                $actualiza = "UPDATE usuarios SET id_status=1 WHERE id='$idusuario'";

                $result = $conn->query($actualiza);

                if ($result = 1) {
                    print("<div class='alert alert-success'>Usuario Activado...</div> ");
                } else {
                    print("<div class='alert alert-warning'>No hay usuario por activar....</div> ");
                }
                header("Refresh:0");
            }
            ?>

            <br><br><br>

            <div class="row">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo Electrónico</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    include ("util.php");

                    $usuarios = "SELECT id, nombre, primer_apellido, segundo_apellido, email, id_status FROM usuarios";
                    $result   = $conn->query($usuarios);
                    $rows     = $result->num_rows;

                    for ($i=1; $i<$rows; $i++) {  // ID = 1 es el Administrador
                        $result->data_seek($i);
                        $row = $result->fetch_array(MYSQLI_ASSOC);
                        // while ($row = mysql_fetch_array($result)) {

                        print("<tr>");
                        print("<td>".$row['id']."</td>");
                        print("<td>".$row['primer_apellido']." ".$row['segundo_apellido'].", ".$row['nombre']."</td>");
                        print("<td>".$row['email']."</td>");

                        if ($row['id_status'] == "1") {
                            print("<td><span class='label label-success'>ACTIVO</span></td>");
                        } else {
                            print("<td><span class='label label-default'>INACTIVO</span></td>");
                        }
                        print("</tr>");
                    }
                    ?>

                    </tbody>
                </table>

                <div class="btn-group">
                    <a class="btn btn-default btn-lg" href="deletesession.php">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        <br>Cerrar Sesión
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
