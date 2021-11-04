<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargos</title>
</head>
<body>
<?php 
include_once("menu.php");
include_once("../bd/cnx.php") ;
?>

<h2>Asignar Jefes de Empleados</h2>

<form action="guardarasignarjefe.php" method="post">

<label for="">Jefe:</label>
<select type="text" name="jefe" id="">
<?php
                $sql = "SELECT id, nombres, apellidos 
                    FROM  empleados 
                    WHERE estatus = ''
                    order by nombres asc";
                $rta = mysqli_query($cnx , $sql);
                
                while ($mostrar = mysqli_fetch_row($rta)) {
                ?>
                    <option value="<?php echo $mostrar['0'] ?>" >
                    <?php echo  $mostrar['1'], $mostrar['2'] ?>
                    </option>
                <?php
                }
?>    
</select>
<br>
<label for="">Supervisado:</label>
<select type="text" name="supervisado" id="">
<?php
                $sql = "SELECT  e.id, e.nombres, e.apellidos, o.cargo
                        FROM  empleados e
                        inner join organigrama o on e.id = o.empleado 
                        WHERE o.cargo > 1 AND e.estatus=''
                        order by e.nombres asc";
                $rta = mysqli_query($cnx , $sql);
                
                while ($mostrar = mysqli_fetch_row($rta)) {
                ?>
                    <option value="<?php echo $mostrar['0'] ?>" >
                    <?php echo  $mostrar['1'], $mostrar['2'] ?>
                    </option>
                <?php
                }
?>    
</select>
<br>
<button type="submit">Agregar supervición</button>


</form>

<br>

<table>
    <caption>Jefes Asignados:</caption>
    <thead>
        <tr>
            <th>id</th>
            <th>Jefe</th>
            <th>Supervisado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <?php    
            $sql = "SELECT j.id, e2.nombres, e2.apellidos, e.nombres, e.apellidos
                    FROM jefede j
                    inner join empleados e2 on j.empleadojefe=e2.id
                    inner join empleados e on j.empleadosupervisado= e.id
                    WHERE e.estatus='' and e2.estatus='' ";
            $rta = mysqli_query($cnx , $sql);

            while ($mostrar = mysqli_fetch_row($rta)) {
            ?>
                <tr> 
                <td> <?php echo $mostrar['0'] ?> </td>
                <td> <?php echo $mostrar['1']." ". $mostrar['2'] ?> </td>
                <td> <?php echo $mostrar['3']." ". $mostrar['4'] ?> </td>
                <td>
                    <a href="">Eliminar</a>
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