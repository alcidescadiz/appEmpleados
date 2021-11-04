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

<h2>Asignar Colaboraciones</h2>

<form action="guardarasignarcolaborador.php" method="post">

<label for="">Colaborará:</label>
<select type="text" name="colabora" id="">
<?php
                $sql = "SELECT  e.id, e.nombres, e.apellidos, o.cargo
                        FROM  empleados e
                        inner join organigrama o on e.id = o.empleado 
                        WHERE o.cargo > 1 and e.estatus =''
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
<label for="">Con:</label>
<select type="text" name="con" id="">
<?php
                $sql = "SELECT  e.id, e.nombres, e.apellidos, o.cargo
                        FROM  empleados e
                        inner join organigrama o on e.id = o.empleado 
                        WHERE o.cargo > 1 and e.estatus=''
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
<button type="submit">Agregar colaboración</button>


</form>

<br>

<table>
    <caption>Colaboraciones:</caption>
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
                    FROM colaboradorde j
                    inner join empleados e2 on j.empleadoayudaa=e2.id
                    inner join empleados e on j.empleadocolaborado= e.id
                    WHERE e2.estatus='' and e.estatus='' and j.estatus='' ";
            $rta = mysqli_query($cnx , $sql);

            while ($mostrar = mysqli_fetch_row($rta)) {
            ?>
                <tr> 
                <td> <?php echo $mostrar['0'] ?> </td>
                <td> <?php echo $mostrar['1']." ". $mostrar['2'] ?> </td>
                <td> <?php echo $mostrar['3']." ". $mostrar['4'] ?> </td>
                <td>
                    <a href="eliminarcolaborador.php? id= <?php echo $mostrar['0'] ?>">Eliminar</a>
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