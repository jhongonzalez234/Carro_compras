<?php
include("conexion.php");
$ruta = "../../img/archivos/";
//insertar

if (isset($_POST['Enviar']) and $_POST['Enviar'] === "Guardar") { // valida el metodo de envio de claves

    // $id es una variable que mediante el metodo post toma el "nombre" del elemento (txt, number, select)
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $detalle = $_POST['detalle'];
    $stock = $_POST['stock'];
    $precio = $_POST['precio'];
    $idCat = $_POST['cbxCategoria'];

    echo $idCat;

    if (!empty($_FILES["foto"]["name"])) {
        $nombreArchivo = $_FILES["foto"]["name"];

        $ruta = $ruta . basename($_FILES["foto"]["name"]);
        if (!(move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta))) {
            echo "error al cargar el archivo";
            return false;
        }
    }




    if (empty($id)) {
         //----------------------------------------- INSERTAR------------------------- 
        $sql = "INSERT INTO productos (nombre,detalle,stock,precio,foto,idCategoria) VALUES ('$nombre','$detalle',$stock,$precio,'$nombreArchivo',$idCat)";
    } else if (!empty($id)) {

        //----------------------------------------- ACTUALIZAR-------------------------  

        if (empty($nombreArchivo)) { //  si el archivo esta vacio
            $sql = "UPDATE productos set nombre = '$nombre', detalle='$detalle',stock='$stock',precio='$precio',idCategoria = '$idCat' where id=$id;";
            if ($conn->query($sql)) {
                // para  direccionar mediante js 
                echo "<script> 
              
              alert('Datos Actualizados correctamente');
              window.location.href= '../FormularioProd.php';
              </script>";

                //header("Location../Index.php");
            } else {
                echo "<script>
              
              alert('Error al Guardar');
              window.location.href= '../FormularioProd.php';
              </script>";
            }
            
        } elseif (!empty($nombreArchivo)) { // si el archivo no está vacio

            $sql = "UPDATE productos set nombre = '$nombre', detalle='$detalle',stock='$stock',precio='$precio',idCategoria = '$idCat', foto ='$nombreArchivo' where id=$id;";

            if ($conn->query($sql)) {
                // para  direccionar mediante js 
                echo "<script> 
              
              alert('Datos Actualizados correctamente');
              window.location.href= '../FormularioProd.php';
              </script>";

                //header("Location../Index.php");
            } else {


                echo "<script>
              
              alert('Error al Guardar');
              window.location.href= '../FormularioProd.php';
              </script>";
            }
        }
    }


    if ($conn->query($sql)) {
        // para  direccionar mediante js 
        echo "<script> 
        
        alert('Datos Guardados correctamente');
        window.location.href= '../FormularioProd.php';
        </script>";

        //header("Location../Index.php");
    } else {


        echo "<script>
        
        alert('Error al Guardar');
        window.location.href= '../FormularioProd.php';
        </script>";
    }

    $conn->close();

     //----------------------------------------- BORRAR------------------------- 
} else if (isset($_POST['Enviar']) and $_POST['Enviar'] === "Eliminar") {
    $id = $_POST['id'];
    $sql = "DELETE FROM productos WHERE id = $id;";
    if ($conn->query($sql)) {
        echo "<script>
        
        alert('Datos Eliminados correctamente');
        window.location.href= '../ListaProd.php';
        </script>";
    } else {
        echo "<script>
        
        alert('Error al Eliminar');
        window.location.href= '../ListaProd.php';
        </script>";
    }
}
echo "aqui";
