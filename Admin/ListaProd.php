<?php

//use PhpMyAdmin\Engines\Bdb;

include("Plantillas/Encabezado.php");
include("BDD/conexion.php");




$sql = "Select p.id,p.nombre AS Nombre, p.detalle AS Detalle,p.precio As Precio,p.stock AS Stock,p.foto As foto, c.nombre AS Categoria FROM productos p, categorias c WHERE p.idCategoria = c.id;";
$result = $conn->query($sql);

?> 

<div class="container">
    <div class="row">


        <table class="table table-striped table-inverse table-responsive">
            <thead class="thead-inverse">
                <tr>
                    <th>NOMBRE</th>
                    <th>DESCRIPCION</th>
                    <th>CARACTERISTICAS</th>
                    <th>STOCK</th>
                    <th>PRECIO</th>
                    <th>FOTO</th>
                    <TH> </TH>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) { // muestra el contenido 
                ?>
                    <tr>
                        <td><?php echo $row["Nombre"]; ?></td>
                        <td><?php echo $row["Detalle"]; ?></td>
                        <td><?php echo $row["Categoria"]; ?></td>
                        <td> <?php echo $row["Stock"]; ?></td>
                        <td><?php echo $row["Precio"]; ?></td> 
                        <td><?php echo $row["foto"]; ?></td>

                        <td><form action="BDD/ProductosCRUD.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $row["id"]; ?>"/>
                            <button type="submit" class="btn btn-danger" name="Enviar" value="Eliminar">Eliminar</button>
                            </form>
                        </td>
                        
                        <td>
                        <form action="FormularioProd.php" method="POST">
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
<?php include("Plantillas/Pie.php"); ?>