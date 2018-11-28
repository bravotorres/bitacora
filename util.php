
<?php
/*
Document   : util
Created on : 7/07/2016
Design     : P.A.B.L.O
Programer  : ...""J.A.L.R.""...
Rev: Alejandro Bravo <quironProject@gmail.com>
*/

// Parámetros  de la Base de Datos:
define('DB_HOST', 'localhost');
define('DB_NAME', 'bitacora');
define('DB_USER', 'root');
define('DB_PASS', 'Alejandro_1');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// $conn= mysqli_connect("localhost","root","EsCoMproyecto","login");

if( !$conn ){
    // die('No pudo conectarse.');
     print("<br><div class='alert alert-danger font' role='alert'>No pudo conectarse a la Base de Datos</div>");
}else{
    // print("successful");
    print("<br><div class='alert alert-success font' role='alert'>Conectado a Base de Datos</div>");
}

?>
