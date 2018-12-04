<!DOCTYPE html>
<?php
// session_start();
date_default_timezone_set('Mexico/General');
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name=viewport content="width=device-width, initial-scale=1">

    <title>Bitácora - Panel del Administrador</title>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

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
                    <h2>Panel Admin</h2>
                </div>


                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Correo Electrónico</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
include ("util.php");

$usuarios = "SELECT id, nombre, primer_apellido, segundo_apellido, email, id_status FROM usuarios";
$result   = $conn->query($usuarios);
$rows = $result->num_rows;

print("<br><div class='alert alert-success font' role='alert'>$usuarios <br> Resultados: $rows</div>");

for ($i=0; $i<$rows; $i++) {
    $result->data_seek($i);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    // while ($row = mysql_fetch_array($result)) {
	
    print("<tr>");
    print("<th scope='row'>$i</th>");
	print("<td>".$row['id']."</td>");
	print("<td>".$row['nombre']."</td>");
	print("<td>".$row['primer_apellido']." ".$row['segundo_apellido']."</td>");
	print("<td>".$row['email']."</td>");
	
    if ($row['id_status'] == "1") {
        print("<td><input type='checkbox' name='status_'".$row['id_status']."' checked> </td>");
    }else{
        print("<td><input type='checkbox' name='status_'".$row['id_status']."' > </td>");
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
?>

</tbody>
               </table>
           </div>
       </div>
   </div>
</body>
</html>
