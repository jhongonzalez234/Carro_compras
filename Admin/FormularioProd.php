<?php include("Plantillas/Encabezado.php");
include("BDD/conexion.php");

$id = "";
$nombre = "";
$detalle = "";
$precio  = "";
$stock = "";
$foto = "";
$categoria = "";
$idCat ="";

/*
if (!isset($_SESSION['PERMISO']) and $_SESSION['PERMISO'] == true) {

    echo "
    <script>      
        alert('Inicie sesion para continuar');
        window.location.href= 'Login.php';
        </script>";
}
*/




if ($_SERVER['REQUEST_METHOD'] === "POST") {




    if (isset($_POST) && $_POST["Actualizar"] == "Actualizar") {
        $id = $_POST["id"];

        $sql = "SELECT * FROM usuarios WHERE id = $id";

        $sql = "SELECT p.id,p.nombre AS Nombre, p.detalle AS Detalle,p.precio As Precio, 
        p.stock AS Stock,p.foto As foto, c.id AS idCat, c.nombre AS Categoria
        FROM productos p, categorias c where p.idCategoria = c.id AND p.id =  $id ";

        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        $id = $row['id'];
        $nombre = $row['Nombre'];
        $detalle = $row['Detalle'];
        $stock = $row['Stock'];
        $precio = $row['Precio'];
        $foto = $row['foto'];
        $idCat = $row['idCat'];
        $categoria = $row['Categoria'];
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br />
            <div class="card">
                Datos - Productos

            </div>
            <div class="card-header">
                <br />
                <form method="POST" enctype="multipart/form-data" action="BDD/ProductosCRUD.php">
                    <!-- Envio de fotografias-->

                    <div class="form-group">


                        <input type="hidden" name="id" value="<?php echo $id; ?>" />

                        <label for="descripcion por nombre">Ingrese sus Nombre del Producto</label>
                        <br /> <br />
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre del Producto" value="<?php echo $nombre; ?>">
                        <br />
                    </div>

                    <div class="form-group">
                        <label>Ingrese Descripcion</label>
                        <br /> <br />
                        <input type="text" class="form-control" id="detalle" name="detalle" value="<?php echo $detalle ?>" placeholder="Ingrese el detalle del producto">
                        <br />
                    </div>




  <!--      Aqui va el combo box  -->

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Categoria Producto</label>
                        </div>

                        <select class="custom-select" id="cbxCategoria" name="cbxCategoria">
                            
                        <?php 
                        if(empty($categoria)){ // valida la seleccion de comboBox segun su estado vacio(NuevoP) Seleccionar; toma el nombre y valor de categorias
                            echo "<option selected> Selecionar</option>";
                        }else{
                           
                            echo "  <option value=$idCat selected > $categoria </option>";
                        }
                         ?>
                            <?php

                             // consulta categorias

                             $sqlCat = "Select id AS idCat, nombre AS categoria from categorias ";

                            $result = $conn->query($sqlCat);

                            while ($row = mysqli_fetch_array($result)) { // se crea un array donde se almacena el id y nombre

                                $idCat = $row['idCat'];
                                $categoria = $row['categoria'];

                            ?>
                                <option value="<?php echo $idCat ?> "><?php echo $categoria ?></option>
                            <?php
                            }

                            ?>
                        </select>
                    </div>








                    <div class="form-group">
                        <label>Ingrese Stock</label>
                        <br /> <br />
                        <input type="number" class="form-control" placeholder="Igrese el Stock" id="stock" name="stock" value="<?php echo $stock; ?>">
                        <br />
                    </div>

                    <div class="form-group">
                        <label>Ingrese precio</label>
                        <br /> <br />
                        <input type="number" class="form-control" step="any" id="precio" name="precio" value="<?php echo $precio; ?>" placeholder="Ingrese la descripción">
                        <br />
                    </div>

                    <div class="form-group">
                        <label>Seleccione una Foto</label>
                        <br /> <br />
                        <input type="file" class="form-control" id="foto" name="foto" placeholder="Seleccione un archivo" accept="image/png, image/jpeg">
                        <br />
                        <h3> <?php echo $foto; ?></h3>
                    </div>




                    <button type="submit" name="Enviar" class="btn btn-primary" value="Guardar">Guardar</button>
                </form>


            </div>
            <div class="card-body">

            </div>
        </div>

    </div>

</div>

</div>

<?php include("Plantillas/Pie.php"); ?>