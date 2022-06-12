<?php

use PhpMyAdmin\Engines\Bdb;

include("Plantillas/Encabezado.php");
include("BDD/conexion.php");

$sql = "Select * from usuarios;";
$result = $conn->query($sql);
/*
if(isset($_SESSION['PERMISO'])and $_SESSION['PERMISO']== true){

// aqui la consulta 
}else{
echo"
    <script>      
        alert('Inicie sesion para continuar');
        window.location.href= 'Login.php';
        </script>";
       
}
*/
?>




<div class="container">
    <div class="row">


        <table class="table table-striped table-inverse table-responsive">
            <thead class="thead-inverse">
                <tr>
                    <th>NOMBRES</th>
                    <th>APELLIDOS</th>
                    <th>USUARIO</th>
                    <!-- <th>CONTRASEÑA</th> -->
                    
                    <TH> </TH> <TH> </TH>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        
                        <td><?php echo $row["nombres"]; ?></td>
                        <td><?php echo $row["apellidos"]; ?></td>
                        <td> <?php echo $row["usr"]; ?></td>
                        <!-- <td><?php echo $row["pass"]; ?></td> -->
                        </td>
                        <td><form action="BDD/UsuariosCRUD.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $row["id"]; ?>"/>
                            <button type="submit" class="btn btn-danger" name="Enviar" value="Eliminar">Eliminar</button>
                            </form>
                        </td>
                        
                        <td>
                        <form action="FormularioUsu.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $row["id"]; ?>"/>
                            <button type="submit" class="btn btn-danger" name="Actualizar" value="Actualizar">Actualizar</button>
                            </form>
                        </td>
                    </tr>
                    <?php
                }
                $conn->close();
                    ?>
        </tbody>
        </table>
    </div>
</div>
<?php include("../Plantillas/Pie.php"); ?>