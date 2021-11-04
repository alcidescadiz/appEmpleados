<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
include_once("menu.php");
include_once("../bd/cnx.php") ;

if (isset($_GET['id'])) {
    $identificacion = $_GET['id'];
}
$sql = "SELECT  e.nombres, e.apellidos, e.direccion, e.telefono, c.estadonombre, p.paisnombre
        FROM  empleados e 
        INNER JOIN ciudades c on c.id = e.idciudad
        INNER JOIN pais p ON c.ubicacionpaisid = p.id
        where e.id = $identificacion";

$rta = mysqli_query($cnx , $sql);
$mostrar = mysqli_fetch_row($rta);
$nombres= $mostrar['0'];
$apellidos= $mostrar['1'];
$direccion= $mostrar['2'];
$telefono = $mostrar['3'];
$ciudad = $mostrar['4'];
$pais= $mostrar['5'];

?>


<h2>Datos del Empleado:</h2>
<h3>Datos personales:</h3>
<h3>Nombres:  <?php  echo $nombres   ?></h3>
<h3>Apellidos:  <?php  echo $apellidos   ?></h3>
<h3>Dirección:  <?php  echo $direccion   ?></h3>
<h3>Telefono:  <?php  echo $telefono   ?></h3>
<h3>Pais:  <?php  echo $pais  ?></h3>
<h3>Ciudad:  <?php  echo $ciudad   ?></h3>
<br>
<h2>Cargos Asignados: -- <a href="asignarCargos.php">(Asignar Cargos)</a></h2>
<ul>
<?php    
            $sql = "SELECT c.cargo from organigrama o
            inner join empleados e on o.empleado = e.id
            inner join cargos c on o.cargo = c.id
            where e.id =$identificacion";
            $rta = mysqli_query($cnx , $sql);

            while ($mostrar = mysqli_fetch_row($rta)) {
            ?>

                <li> <?php echo $mostrar['0'] ?>  <a href="">Eliminar</a></li>

            <?php
            }
            ?>
</ul>
<br>
<h2>Jefe de: -- <a href="asignarJefe.php">(Asignar personal a supervisar)</a></h2>
<ul>
<?php    
            $sql = "SELECT e.nombres, e.apellidos
                    FROM jefede j
                    inner join empleados e on j.empleadosupervisado= e.id
                    where j.empleadojefe = $identificacion";
            $rta = mysqli_query($cnx , $sql);
            $i =0;
            while ($mostrar = mysqli_fetch_row($rta)) {    
            ?>
            <li> <?php echo $mostrar['0']." ".$mostrar['1'] ?>  <a href="">Eliminar</a></li>
            <?php
            $i++;
            }
            if ($i<1) {
                echo "<li> No tiene personal asignado</li>";
                    
            }
            ?>
</ul>
<br>
<h2>Colaborador de: -- <a href="asignarColaborador.php">(Asignar personal a colaborar)</a></h2>
<ul>
<?php    
            $sql = "SELECT e.nombres, e.apellidos
                    FROM colaboradorde c
                    inner join empleados e on c.empleadocolaborado= e.id
                    where c.empleadoayudaa = $identificacion";
            $rta = mysqli_query($cnx , $sql);
            $i =0;
            while ($mostrar = mysqli_fetch_row($rta)) {    
            ?>
            <li> <?php echo $mostrar['0']." ".$mostrar['1'] ?>  <a href="">Eliminar</a></li>
            <?php
            $i++;
            }
            if ($i<1) {
                echo "<li> No tiene personal a colaborar</li>";
                    
            }
            ?>
</ul>








</body>
</html>