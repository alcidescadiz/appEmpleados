<?php

$identificacion = $_POST['identificacion'];
$cargo = $_POST['cargo'];


include_once("../bd/cnx.php");


$sql = "INSERT INTO `organigrama`( `cargo`, `empleado`) VALUES ('$cargo', '$identificacion')";
$rta = mysqli_query($cnx , $sql);

if ( !$rta ){
	echo "No se insertó";
 
} else {
	header("location: asignarCargos.php");
}
?>