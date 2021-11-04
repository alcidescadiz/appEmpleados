<?php

$id = $_GET['id'];
include_once("../bd/cnx.php");

$sql =  "UPDATE organigrama set  estatus='Anulada' where id='$id'";
$rta = mysqli_query($cnx , $sql);


if ( !$rta ){
	echo "No se eliminó";
} else {
	header("location: asignarCargos.php");
}





?>