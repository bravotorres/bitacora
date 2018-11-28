
<?php
/*
Document   : util
Created on : 7/07/2016
Design     : P.A.B.L.O
Programer  : ...""J.A.L.R.""...
Rev: Alejandro Bravo <quironProject@gmail.com>
*/
// $conn= mysqli_connect("localhost","root","EsCoMproyecto","login");
$conn = mysqli_connect("localhost","root","Alejandro_1","bitacora");
print("<div class='alert alert-success font'>$conn</div>");
if( !$conn ){
    // die('No pudo conectarse.');
     print("<br><div class='alert alert-danger font' role='alert'>No pudo conectarse a la Base de Datos</div>");
}else{
    // print("successful");
    print("<br><div class='alert alert-success font' role='alert'>Conectado a Base de Datos</div>");
}

?>
