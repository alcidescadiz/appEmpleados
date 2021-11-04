<?php
$idciudad = $_POST['idciudad'];
$identificacion = $_POST['identificacion'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];

include_once("../bd/cnx.php");

$sql = "INSERT INTO `empleados`(`identificacion`, `nombres`, `apellidos`, `direccion`, `telefono`, `idciudad`) VALUES ('$identificacion','$nombres' ,'$apellidos','$direccion','$telefono','$idciudad')";
$rta = mysqli_query($cnx , $sql);

if ( !$rta ){
	echo "No se insertó";
} else {
	header("location: empleado.php");
}
?>