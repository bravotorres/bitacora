
<?php
/*
Document   : util
Created on : 7/07/2016
Design     : P.A.B.L.O
Programer  : ...""J.A.L.R.""...
Rev: Alejandro Bravo <quironProject@gmail.com>
*/
// $conn= mysqli_connect("localhost","root","EsCoMproyecto","login");
$conn= mysqli_connect("localhost","root","leonidas","login"); 

if  (!$conn) {
    die('No pudo conectarse: '. mysql_error());
}else{
    print("successful");	
}

?>
