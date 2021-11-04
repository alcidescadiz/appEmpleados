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
if (isset($_GET['pais'])) {
    $pais = $_GET['pais'];
    $nombrepais=$_GET['nombrepais'];
}else{
    $pais =95;
    $nombrepais='Venezuela';
}
?>

<h2>Empleado nuevo:</h2>

<form action="guardarempleado.php" method="post">
<label for="">Pais:</label>
<select type="text" name="pais" id="paisid" onchange="capturarpais()">
<option value="<?php echo $pais  ?>"><?php echo $nombrepais  ?></option>
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
<select type="text" name="idciudad" id="">
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
<input type="number" name="identificacion" id="">
<br>

<label for="">Nombres:</label>
<input type="text" name="nombres" id="">
<br>

<label for="">Apellidos:</label>
<input type="text" name="apellidos" id="">
<br>

<label for="">Dirección:</label>
<input type="text" name="direccion" id="">
<br>

<label for="">Telefono:</label>
<input type="text" name="telefono" id="">
<br>

<button type="submit">Guardar</button>









</form>

<script>
    function capturarpais(){
        paisid= document.getElementById("paisid").value;
        combo = document.getElementById("paisid");
        nombrepais = combo.options[combo.selectedIndex].text;
        window.location="empleadoNuevo.php? pais="+paisid+"& nombrepais="+nombrepais;
    }
</script>


</body>
</html>