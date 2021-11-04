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

<h2>Asignar Cargos a los Empleados</h2>

<form action="guardarasignarcargo.php" method="post">

<label for="">Empleado:</label>
<select type="text" name="identificacion" id="">
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
<label for="">Cargo:</label>
<select type="text" name="cargo" id="">
<?php
                $consulta= "SELECT  min(cargo) 
                            from organigrama
                            where estatus='' ";
                $res= mysqli_query($cnx , $consulta);

                $dato = mysqli_fetch_row($res);

                if ($dato['0']==1) {
                    $sql = "SELECT id, cargo 
                    FROM  cargos 
                    WHERE id != 1
                    order by cargo asc";
                }else{
                $sql = "SELECT id, cargo 
                        FROM  cargos 
                        order by cargo asc";
                }
                $rta = mysqli_query($cnx , $sql);
                
                while ($mostrar = mysqli_fetch_row($rta)) {
                ?>
                    <option value="<?php echo $mostrar['0'] ?>" >
                    <?php echo  $mostrar['1'] ?>
                    </option>
                <?php
                }
?>    
</select>
<br>
<button type="submit">Agregar Cargo</button>


</form>

<br>

<table>
    <caption>Cargos Asignados:</caption>
    <thead>
        <tr>
            <th>Identificación</th>
            <th>Empleado</th>
            <th>Cargo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <?php    
            $sql = "SELECT e.identificacion, e.nombres, e.apellidos, c.cargo, o.id
                    from organigrama o
                    inner join empleados e on o.empleado = e.id
                    inner join cargos c on o.cargo = c.id
                    where e.estatus='' and o.estatus='' ";
            $rta = mysqli_query($cnx , $sql);

            while ($mostrar = mysqli_fetch_row($rta)) {
            ?>
                <tr> 
                <td> <?php echo $mostrar['0'] ?> </td>
                <td> <?php echo $mostrar['1']." ". $mostrar['2'] ?> </td>
                <td> <?php echo $mostrar['3'] ?> </td>
                <td>
                    <a href="eliminarcargo.php? id= <?php echo $mostrar['4'] ?>">Eliminar</a>
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