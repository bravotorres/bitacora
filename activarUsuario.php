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
                <h1>Activción de Ususarios.</h1>
            </div>

            <form action="#" method="POST" name="form" id="form">
                <div class="row">

                    <div class="col-md-4">
                        <label>Buscar usuario:</label>
                        <select name="usuario" id="usuario">
                            <option>Elige un usuario.</option>

                            <?php
                            include ("util.php");
                            $consulta = "SELECT 
                                  UPPER(id) idusuarios, 
                                  UPPER(username) username, 
                                  UPPER(primer_apellido) apaterno, 
                                  UPPER(segundo_apellido) amaterno 
                                FROM usuarios where id_status=2 ORDER BY username ASC";

                            $res = $conn->query($consulta);

                            print("<br><br><br><div class='alert alert-success' role='alert'>$consulta</div>");

                            $filas = $res->num_rows;

                            for ($j=0; $j<$filas; ++$j) {
                                $res->data_seek($j);
                                $fila = $res->fetch_array(MYSQLI_ASSOC);
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
                        <button class="btn btn-primary btn-lg" type="submit" name="busca" id="busca">Activar Usuario</button>
                        <br><br><br>
                    </div>

                </div>
            </form>

            <form method="post" action="" role="form">
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
//                    print("<th scope='row'>$i</th>");
                    print("<td>".$row['id']."</td>");
                    print("<td>".$row['primer_apellido']." ".$row['segundo_apellido'].", ".$row['nombre']."</td>");
                    print("<td>".$row['email']."</td>");

                    if ($row['id_status'] == "1") {
                        print("<td><input type='checkbox' name='opciones[]' value='status_".$row['id']."_1' checked> </td>");
                    } else {
                        print("<td><input type='checkbox' name='opciones[]' value='status_".$row['id']."_2' > </td>");
                    }
                    print("</tr>");

                    // print("<td name='$status_id"."_"."$i'>".
                    //     "<div class="input-group mb-3">".
                    //     "<div class="input-group-prepend">".
                    //     "<div class="input-group-text">".
                    //     "<input type="checkbox" aria-label="CHBX">".
                    //     "</div>".
                    //     "</div>".
                    //     "</div>".
                    //     "</td>");
                }

                // if (isset($_POST['registrar'])) {
                //     $machine = $_POST['machine'];
                //     $comment = $_POST['comment'];
                //     $update = "UPDATE registro SET
                //     hora_salida=now(),
                //     maquina='$machine',
                //     comentario='$comment'
                //     WHERE id='$idregistro' and date(hora_entrada)=date(now())";

                //     $result = $conn->query($update);
                //     print("<br><div class='alert alert-success font' role='alert'>Buen dia $name su hora  de salida se ha registrado: $datetimenow  ,<a href='deletesession.php'> <b>has click aqui para terminar</b></a></div>");
                // }

//                <input type="checkbox" value="menu_news" name="check_menus[]" />
//                <input type="checkbox" value="menu_gallery" name="check_menus[]" />
                //EMPTY ALL VALUES TO 0
//                $queryMU ='UPDATE usuarios SET menu_news = 0, menu_gallery = 0, menu_events = 0, menu_contact = 0';
//                $stmtMU = $conn->prepare($queryMU);
//                $stmtMU->execute();

                if(isset($_POST['opciones'])) {
                    print ("<h3>".sizeof($_POST['opciones'])."</h3>");
                    foreach($_POST['opciones'] as $checkU) {
                        try {
                            print ("<h1>$checkU</h1>");
                            $nom = explode("_", $checkU);
                            print("<br><h3>DB_ID: ".$nom[1].", STATUS: ".$nom[2]."</h3>");
                            //UPDATE only the values checked
                            $query = "UPDATE usuarios SET id_status='".$nom[2]."' WHERE id='".$nom[1]."'";
                            print("<br><br><br><div class='alert alert-success' role='alert'>$query</div>");
                            $stmtMU = $conn->prepare($query);
                            $stmtMU->execute();
                        } catch(PDOException $e){
                            $msg = 'Error: '.$e->getMessage();
                        }
//                        header("Refresh:0");
                    }
                }
                ?>

                </tbody>
            </table>
            <button type="submit" id="guardar" class="btn btn-default">
                <span>Guardar</span>
            </button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
