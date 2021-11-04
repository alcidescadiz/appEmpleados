<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php include_once("../bd/cnx.php")  ?>    
<?php 
include_once("menu.php");  

$id= $_GET['id'];
$empleado = "SELECT nombres, apellidos, direccion, telefono, idciudad, identificacion
             FROM  empleados
             where id = $id";
$res = mysqli_query($cnx , $empleado);
$datos = mysqli_fetch_row($res);

$nombres= $datos['0'];
$apellidos=$datos['1'];
$direccion=$datos['2'];
$telefono=$datos['3'];
$idciudad=$datos['4'];
$identificacion= $datos['5'];

$consultapais = "SELECT c.estadonombre, p.paisnombre, p.id from ciudades c
                inner join pais p on c.ubicacionpaisid = p.id
                where c.id=$idciudad";
$respais = mysqli_query($cnx , $consultapais);
$datopais = mysqli_fetch_row($respais);
$paiseditar= $datopais['1'];
$paisid=$datos['2'];
$ciudad= $datopais['0'];

if (isset($_GET['pais'])) {
    $pais = $_GET['pais'];
    $paiseditar= $_GET['nombrepais'];
    $ciudad='Seleccione';
}
?>

<h2>Empleado nuevo:</h2>

<form action="actualizarempleado.php" method="post" ">
<input type="hidden" id="id" name="id" value="<?php echo $id ?>" >
<label for="">Pais:</label>
<select type="text" name="pais" id="paisid"   onchange="capturarpais()">
 <option value="<?php echo $pais; ?>"><?php echo $paiseditar; ?></option>
  
<?php
                $sql = "SELECT * FROM  pais order by paisnombre asc";
                $rta = mysqli_query($cnx , $sql);
                
                while ($mostrar = mysqli_fetch_row($rta)) {
                ?>
                    <option value="<?php echo $mostrar['0'] ?>" >
                    <?php echo $mostrar['1'] ?>                    
                    </option>
                <?php
                }
?>
</select>
<label for="">Ciudad:</label>
<select type="text" name="idciudad" id="" >
<option value="<?php echo $idciudad ?>"><?php echo $ciudad ?></option>

<?php
                $sql = "SELECT * FROM  ciudades where ubicacionpaisid=$pais order by estadonombre asc";
                $rta = mysqli_query($cnx , $sql);
                
                while ($mostrar = mysqli_fetch_row($rta)) {
                ?>
                    <option value="<?php echo $mostrar['0'] ?>" >
                    <?php echo $mostrar['2'] ?>
                    </option>
                <?php
                }
?>    
</select>
<br>
<label for="">Número de identificación:</label>
<input type="text" name="identificacion" value="<?php echo $identificacion; ?>">
<br>

<label for="">Nombres:</label>
<input type="text" name="nombres" id="" value="<?php echo $nombres; ?>">
<br>

<label for="">Apellidos:</label>
<input type="text" name="apellidos" id="" value="<?php echo $apellidos; ?>">
<br>

<label for="">Dirección:</label>
<input type="text" name="direccion" id="" value="<?php echo $direccion; ?>">
<br>

<label for="">Telefono:</label>
<input type="text" name="telefono" id="" value="<?php echo $telefono; ?>">
<br>

<button type="submit">Actualizar</button>









</form>

<script>
    function capturarpais(){
        paisid= document.getElementById("paisid").value;
        combo = document.getElementById("paisid");
        nombrepais = combo.options[combo.selectedIndex].text;
        id=document.getElementById("id").value;

        window.location="empleadoEditor.php? pais="+paisid+"&id="+id+"&nombrepais="+nombrepais;
    }
</script>


</body>
</html>