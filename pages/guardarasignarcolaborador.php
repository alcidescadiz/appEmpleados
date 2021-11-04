<?php

$tipo = 2;
$colabora = $_POST['colabora'];
$con = $_POST['con'];


include_once("../bd/cnx.php");

$sql = "INSERT INTO `colaboradorde`( `tipo`,`empleadoayudaa`, `empleadocolaborado`) VALUES ('$tipo','$jefe', '$supervisado')";
$rta = mysqli_query($cnx , $sql);

if ( !$rta ){
	echo "No se insertó";
 
} else {
	header("location: asignarColaborador.php");
}
?>