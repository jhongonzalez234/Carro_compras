<?php
include("fpdf/fpdf.php"); // libreria fpdf 
include("Admin/BDD/Conexion.php");




  
  if (isset($_POST) && $_POST["Pagar"] == "Pagar") {

   
  $idCliente = $_POST["idCliente"];


    $sql = "SELECT * FROM clientes WHERE id = $idCliente";
 

    $sql ="SELECT f.id AS numFac, f.fecha, f.subtotal,f.iva, f.apagar AS total, 

    df.cantidad AS canProd, df.precioVenta AS preProd, df.importe AS impProd, 
    
    c.nombres AS nomCli ,c.apellidos AS apeCli, c.cedula AS cedula,
      
    p.nombre AS nomProd , p.detalle AS detProd
    
    FROM  productos p, clientes c,  factura f, detallefactura df 
    
    WHERE df.idFactura = f.id and f.idClientes = c.id and df.idProductos = p.id and f.idClientes = $idCliente;";
   




    $res =  $conn->query($sql);
    $tot = $res->fetch_assoc();
    
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    
  



echo "mierdaa ---> $idCliente";
  
    class PDF extends FPDF
    {

    function Header()
    {

    $this->Image('img/detalle.png',-10,-1,180); // baner al costado izquierdo 
    // $this->Image('img/apple.png',-10,-1,170);
    }

    }



    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->SetFillColor(200,220,100);
    $pdf->SetFont('Arial','B',16);
    $pdf-> Ln(); // salto de linea 

    $pdf->Image("img/apple.png",170,10,25,25,"PNG");

    $pdf->SetFont('Arial','B','25');
    $pdf->setXY(85, 5);
    $pdf->write(40, 'FACTURA #' ." ". $row["numFac"]);
    $pdf->Ln();
    $pdf->SetFont('Arial','B','20');
    $pdf->Cell(195,10, 'ALMACENES EL AHORRO',0,0,'C',0);
    $pdf->Ln();
    $pdf->Ln();
    /////////////////////////////////////////////// Datos del cliente 
    $pdf->SetFont('Arial','B','15');
    $pdf->Cell(195,10, 'Datos del cliente:',0,0,'C',0);
    $pdf->Ln();
    $pdf->Ln();
    $pdf->SetFont('Arial','I','12');
    $pdf->Cell(85,10, 'Fecha:'." ".  $row["fecha"],0,0,'C',0);
    $pdf->Ln();
    $pdf->Cell(90,10, 'Nombre:'." ".  $row["nomCli"]." ".$row["apeCli"],0,0,'C',0);
    $pdf->Cell(120,10, 'CI/RUC'." ".  $row["cedula"],0,0,'C',0);
    $pdf->Ln();
    $pdf->Ln();

    //////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////// Cabezera de la tabla 
    $pdf->SetFont('Arial','B','12');
    $pdf->Cell(195,10, 'Detalle de productos:',0,0,'C',0);
    $pdf->Ln();
    $pdf->SetX(25); // centra la tabla 

    $pdf ->Cell(15,10,utf8_decode('#Prod'),1,0,'C',0);
    $pdf->Cell(25,10,utf8_decode('Cantidad'),1,0,'C',0);
    $pdf->Cell(40,10,utf8_decode('Nombre'),1,0,'C',0);
    $pdf->Cell(40,10,utf8_decode('Detalle'),1,0,'C',0);
    $pdf->Cell(25,10,utf8_decode('Precio U'),1,0,'C',0);
    $pdf->Cell(25,10,utf8_decode('total'),1,0,'C',0);
    $pdf->Ln(10);
    $i=0;

    //////////////////////////// Cuerpo de la tabla 
    while($row = $result->fetch_assoc()){ //hace el barrido de datos
          
          $i++;
        $pdf->SetX(25); // centra la tabla 
        $pdf ->Cell(15,10,$i,1,0,'C',0);
        $pdf->Cell(25,10,$row["canProd"],1,0,'C',0);
        $pdf->Cell(40,10,$row["nomProd"],1,0,'C',0);
        $pdf->Cell(40,10,$row["detProd"],1,0,'C',0);
        $pdf->Cell(25,10,$row["preProd"],1,0,'C',0);
        $pdf->Cell(25,10,$row["impProd"],1,0,'C',0);
      
        $pdf->Ln();
      
          
    }

    ////////////////////////////////////////////////// Dato FInal 

    $pdf->Ln();

    $pdf->SetFont('Arial','I','14');
    $pdf->Cell(325,10, 'Subtotal:'." ".  $tot["subtotal"],0,0,'C',0);
    $pdf->Ln();
    $pdf->Cell(325,10, '%Iva:'." ".  $tot["iva"],0,0,'C',0);
    $pdf->Ln();
    $pdf->Cell(325,10, 'Total:'." ".  $tot["total"],0,0,'C',0);
    $pdf->Ln();



    $pdf -> Output();
  }
 
    ?>