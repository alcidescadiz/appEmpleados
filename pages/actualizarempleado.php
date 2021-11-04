<?php

$id = $_POST['id'];
$idciudad = $_POST['idciudad'];
$identificacion = $_POST['identificacion'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];

include_once("../bd/cnx.php");

$sql =  "UPDATE empleados set  idciudad='$idciudad', identificacion='$identificacion', nombres='$nombres', apellidos='$apellidos', direccion='$direccion', telefono='$telefono' where id='$id'";
$rta = mysqli_query($cnx , $sql);


if ( !$rta ){
	echo "No se eliminó";
} else {
	header("location: empleado.php? id=$id");
}





?>