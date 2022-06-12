<?php
include("../BDD/Conexion.php");

//insertar

if (isset($_POST['Enviar']) and $_POST['Enviar'] === "Guardar") {
    $id = $_POST['id'];
    $nombre = $_POST['categoria'];
   
    
  

    if (empty($id)) {
        $sql = "INSERT INTO categorias (nombre) VALUES ('$nombre')";
        if ($conn->query($sql)) {
      
            echo "<script>
            
            alert('Datos Guardados correctamente');
            window.location.href= '../FormularioCat.php';
            </script>";
           
            //header("Location../Index.php");
        } else {
        
        
            echo "<script>
            
            alert('Error al Guardar');
            window.location.href= '../FormularioCat.php';
            </script>";
        
        }

    } else if (!empty($id)) {

        $sql = "UPDATE categorias set nombre = '$nombre' where id=$id;";
        if ($conn->query($sql)) {
            echo "<script>
            
            alert('Usuario Actualizado correctamente');
            window.location.href= '../FormularioCat.php';
            </script>";
        } else {
            echo "<script>
            
            alert('Error al Actualizar Usuario');
            window.location.href= '../FormularioCat.php';
            </script>";
        }
    }


    

    $conn->close();
} else if (isset($_POST['Enviar']) and $_POST['Enviar'] === "Eliminar") {

    $id = $_POST['id'];
    $sql = "DELETE FROM categorias WHERE id = $id;";

    if ($conn->query($sql)) {
        echo "<script>
        
        alert('Usuario Eliminado correctamente');
        window.location.href= '../FormularioCat.php';
        </script>";
    } else {
        echo "<script>
        
        alert('Error al Elimir Usuario');
        window.location.href= '../FormularioCat.php';
        </script>";
    }

}