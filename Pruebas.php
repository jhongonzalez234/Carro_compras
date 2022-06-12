<?php

include("fpdf/fpdf.php");

class PDF extends FPDF
{
function Header()
    {
    global $title;

    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Calculamos ancho y posición del título.
    $w = $this->GetStringWidth($title)+6;
    $this->SetX((210-$w)/2);
    // Colores de los bordes, fondo y texto
    $this->SetDrawColor(0,80,180);
    $this->SetFillColor(230,230,0);
    $this->SetTextColor(220,50,50);
    // Ancho del borde (1 mm)
    $this->SetLineWidth(1);
    // Título
    $this->Cell($w,9,$title,1,1,'C',true);
    // Salto de línea
    $this->Ln(10);
    }
}

/* --------------------------------------- Cuerpo
$objfpdf = new FPDF('P','mm','A4');
$objfpdf -> AddPage();
$objfpdf-> SetFont("Arial","I",12);

// posicion x,y. ancho y alto   
$objfpdf->Image("img/apple.png",180,5,25,25,"PNG");
$objfpdf-> Cell(50,10,'Title',1,0,'C');

$objfpdf-> Cell(40,25,"apple store");

$objfpdf-> Ln(); // salto de linea 
$objfpdf-> Cell(40,10,"Hola ISTVN");
$objfpdf-> Cell(40,10,"Hola ISTVN");

$objfpdf-> Ln(); // salto de linea 



$objfpdf-> Cell(40,10,"Hola ISTVN");
$objfpdf-> Cell(40,10,"Hola ISTVN");
$objfpdf-> Cell(40,10,"Hola ISTVN");

for($i=0;$i<100; $i++){

    $objfpdf-> Cell(40,10,"Hola ISTVN");
    $objfpdf-> Ln(); // salto de linea 
 


}
*/

$objfpdf -> Output();



?> 

