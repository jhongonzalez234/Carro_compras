<?php 

header('Content-type:application/vnd.ms-excel;charset=URF-8');
header('Content-Disposition: attachment; filename = Reporte.xls');

include("Admin/BDD/conexion.php");


///////////////////////////////////////////////////////////////////////////////////////////////////////
$idFac = $_POST["idFac"];


echo $idFac;

$sqlF = "SELECT * FROM factura WHERE id=$idFac";

$result = $conn->query($sqlF);

$rowsq = $result->fetch_assoc();

$idCli = $rowsq["idClientes"];

///////////////////////////////////////////////////////////////////////////////////////////////////////

$sqlC = "SELECT * FROM clientes WHERE id=$idCli";

$result = $conn->query($sqlC) or die($conn->error);

$rowsq = $result->fetch_assoc();

$nombreCli = $rowsq["nombres"] . " " . $rowsq["apellidos"];


///////////////////////////////////////////////////////////////////////////////////////////////////

$sql = "SELECT f.id AS numFac, f.fecha, f.subtotal,f.iva, f.apagar AS total, 

df.cantidad AS canProd, df.precioVenta AS preProd, df.importe AS impProd, 

c.nombres AS nomCli ,c.apellidos AS apeCli, c.cedula AS cedula,
  
p.nombre AS nomProd , p.detalle AS detProd

FROM  productos p, clientes c,  factura f, detallefactura df 

WHERE df.idFactura = f.id and f.idClientes = c.id and df.idProductos = p.id and f.idClientes = $idCli and f.id =$idFac ;";


$result = $conn->query($sql);


////////////////////////////////////////////////////////////////////////////////////////

$sql1 = "SELECT f.id AS numFac, f.fecha, f.subtotal,f.iva, f.apagar AS total, 

df.cantidad AS canProd, df.precioVenta AS preProd, df.importe AS impProd, 

c.nombres AS nomCli ,c.apellidos AS apeCli, c.cedula AS cedula,
  
p.nombre AS nomProd , p.detalle AS detProd

FROM  productos p, clientes c,  factura f, detallefactura df 

WHERE df.idFactura = f.id and f.idClientes = c.id and df.idProductos = p.id and f.idClientes = $idCli and f.id =$idFac ;";


$res =  $conn->query($sql1);
$tot = $res->fetch_assoc();

$i=0;


?> 




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1 align="center" > FACTURA #  <?php echo $tot["numFac"];?> </h1>


<h2 align="center" > ALMACENES EL AHORRO</h2>
<h3 align="center"> DATOS DEL CLIENTE</h3>
<table>

<tr>

<th></th>




    <tr>  <th> Fecha: </th>  <th > <?php    echo  $tot["fecha"];?> </th> </tr>

    <tr>      <th >Nombre: </th> <th > <?php    echo  $tot["nomCli"]." ".$tot["apeCli"];?> </th>  <th> </th> <th >CI/Ruc: </th> <th > <?php echo   $tot["cedula"];?> </th>  </tr>

    <tr></tr>
</table>

<table border="1">
    <caption>LISTA DE PRODUCTOS</caption>        
                <tr>
                    <th >#Prod</th>
                    <th>Cantidad</th>
                    <th>Nombre</th>
                    <th>Detalle</th>
                    <th>Precio U</th>
                    <th>TOTAL</th>
                </tr>
            
            
                <?php
                while ($row = $result->fetch_assoc()){ 
                    $i++;
                ?>
                    <tr>
                    <td><?php   echo $i ?></td>
                  
                        <td><?php echo $row["canProd"]; ?></td>
                        <td><?php echo $row["nomProd"]; ?></td>
                        <td><?php echo $row["detProd"]; ?></td>
                        <td><?php echo $row["preProd"]; ?></td>
                        <td><?php echo$row["impProd"]; ?></td>
                       
                    </tr>
                    <?php
                }
                //$conn->close();
                    ?>
        
        
        </table>

        <br>

        <table >
                <?php
              
$res =  $conn->query($sql1);
$tot = $res->fetch_assoc();

                ?>

                    <tr >
                
                    <th></th><th></th><th></th><th></th>

                    <th border="1" >SUB TOTAL</th>
                        <td border="1" ><?php echo  $tot["subtotal"]; ?></td>
                    </tr>

                    <tr>
<th></th><th></th><th></th><th></th>

                    <th border="1" >IVA(%12)</th>
                       <td border="1" ><?php echo  $tot["iva"]; ?></td>
                    </tr>

                    <tr>
                    <th></th><th></th><th></th><th></th>
                    <th border="1" >TOTAL</th>
                        <td border="1" ><?php echo $tot["total"]; ?></td>
                    </tr>

                    <?php
                
                $conn->close();
                    ?>
        </table>

</body>
</html>