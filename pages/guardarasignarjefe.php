<?php

$tipo = 1;
$jefe = $_POST['jefe'];
$supervisado = $_POST['supervisado'];


include_once("../bd/cnx.php");

$sql = "INSERT INTO `jefede`( `tipo`,`empleadojefe`, `empleadosupervisado`) VALUES ('$tipo','$jefe', '$supervisado')";
$rta = mysqli_query($cnx , $sql);

if ( !$rta ){
	echo "No se insertó";
 
} else {
	header("location: asignarJefe.php");
}
?>