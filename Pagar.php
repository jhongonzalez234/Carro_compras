<?php
include("Plantillas/Encabezado.php");
include("Admin/BDD/conexion.php");

session_start();
$verificar = true;

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $user = $_POST['usr'];
    $pass = $_POST['pwd'];

    $sql = "SELECT * FROM clientes WHERE usr = '$user' and pwd = '$pass';";
    $res = $conn->query($sql);

    if ($res->num_rows == 1) {
        $row = $res->fetch_assoc();
        $id = $row["id"];
        $subTotal = 0;
        $IVA = 0;
        $aPagar = 0;

        foreach ($_SESSION["CARRITO"] as $elemento) {
            $subTotal += $elemento["importe"];
        }
        $IVA = $subTotal * 0.12;
        $aPagar = $subTotal + $IVA;

        // la cabecera de la factura 
        $sql = "INSERT INTO factura VALUES (null,CURDATE(),$subTotal,$IVA,$aPagar,$id);";
        $idFac =0; 



        if (!$conn->query($sql)) {    
                $verificar = false;}
                else{
                    $idFac = $conn->insert_id;
                }

    
                // insertar el detalle de los productos 
                // barre los productos que compro 
              
                foreach ($_SESSION["CARRITO"] as $elemento) {
                    $idp=$elemento['id'];
                    $cantidad = $elemento["cantidad"];
                    $precio = $elemento["precio"];
                    $importe = $elemento['importe'];
               
                    $sql="insert into detallefactura values (null,$cantidad,$precio,$importe,$idFac,$idp)";
                  
                    if (!$conn->query($sql)) {
            
                        $verificar = false;}
                }
        if ($verificar) {
            //echo "<script>
            //window.location.href = 'Factura.php?idFac=$idFac';
            //alert('Bienvenido, compra realizar.');
            //window.location.href = 'Factura.php';
            //</script>";
            session_destroy();
            echo '<form name="pdfform"  target="_blank" id="pdf" action="prueba.php"  method="post" >
                  <input id="pdfidfac" name="idFac" type="hidden" value="' . strval($idFac) . '">
                  </form>
                  
                  <form name="pdfform1"  target="_blank" id="excel" action="facExcel.php"  method="post" >
                  <input id="pdfidfac1" name="idFac" type="hidden" value="' . strval($idFac) . '">
                  </form>
                  
                  <script>
                  alert("Bienvenido, compra realizar. ' . $idFac . '");
                  document.forms["pdfform"].submit();
                  document.forms["pdfform1"].submit();
                  </script>';
        } else {
            echo "<script>
            alert('$sql');
            alert('Bienvenido, ERROR al comprar.');
            window.location.href = 'Index.php';
            </script>";
        }
    } else {
        echo "<script>alert('NO Bienvenido')</script>";
    }
}
?>

<div class="container">
    <div class="row">
        <form method="POST">
            <div class="mb-3">
                <br>
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="text" class="form-control" name="usr" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text">We'll never share your email with anyone else.</small>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="pwd" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Iniciar Session</button>
        </form>
             
    </div>
</div>

<?php
include("Plantillas/Pie.php");
?>