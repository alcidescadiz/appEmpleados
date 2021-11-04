<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
</head>
<body>
<?php 
include_once("menu.php");
include_once("../bd/cnx.php");


?>
<button><a href="empleadoNuevo.php">Agregar Nuevo Empleado</a></button>
<table>
    <caption>Empleados:</caption>
    <thead>
        <tr>
            <th>Identificación</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <?php    
            $sql = "SELECT identificacion, nombres, apellidos, id 
                    FROM  empleados 
                    WHERE estatus= ''
                    order by nombres asc";
            $rta = mysqli_query($cnx , $sql);

            while ($mostrar = mysqli_fetch_row($rta)) {
            ?>
                <tr> 
                <td> <?php echo $mostrar['0'] ?> </td>
                <td> <?php echo $mostrar['1'] ?> </td>
                <td> <?php echo $mostrar['2'] ?> </td>
                <td>
                <a href="datosempleado.php? id= <?php echo $mostrar['3'] ?>"> Ver</a>
                <a href="empleadoEditor.php? id= <?php echo $mostrar['3'] ?>"> Editar</a>
                <a href="eliminarempleado.php? id= <?php echo $mostrar['3'] ?>">Eliminar</a>
                 </td>
                </tr>
            <?php
            }
        ?>

        </tr>
    </tbody>

</table>




</body>
</html>