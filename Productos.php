<?php
include("Plantillas/Encabezado.php");
include("Admin/BDD/conexion.php");

$sql = "SELECT * FROM productos WHERE stock >= 1 ;";

$result = $conn->query($sql);
?>

<div class="container"  
  >
    <div class="row">
        <?php while($row = $result->fetch_assoc()){ ?>
        <div class="col-md-3">
        <div class="card text-left">
          <img class="card-img-top" src="img/archivos/<?php echo $row['foto']?>" alt="">
        
      
          <div class="card-body">
          
        <li class="list-group-item list-group-item-primary "><h7 class="card-title"> Producto:</h7></li>
        <li class="list-group-item list-group-item-primary"><h4 class="card-title"><b><?php echo $row['nombre']?> </b> </h4></li>
        <li class="list-group-item list-group-item-secondary"><h7 class="card-title">Detalle:</h7></li>
        <li class="list-group-item list-group-item-secondary  "> <p class="card-text"> <b><?php echo $row['detalle']?></b></p></li>
        <li class="list-group-item list-group-item-success"><h7 class="card-title">Precio:</h7></li>
        <li class="list-group-item list-group-item-success"> <h4 class="card-text"> <b><?php echo "$", $row['precio']?></b></h4></li>
      
            
           
           
            <form  style="  padding-top:  10px;" class="btnAgregar" action="Carrito.php" method="POST">
                <input type="hidden"   name="id" value="<?php echo $row['id']?>"/>
                <button type="submit"  style="  margin-left:35%; "  class="btn btn-success" name="Agregar" value="Agregar">Agregar</button>
            </form>
          </div>
        </div>
        </div>
        <?php
        }
        $conn->close();
        ?>
    </div>
</div>