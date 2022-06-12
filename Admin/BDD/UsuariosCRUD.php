<?php
include("../BDD/Conexion.php");

//insertar

if (isset($_POST['Enviar']) and $_POST['Enviar'] === "Guardar") {
    $id = $_POST['id'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $usuario = $_POST['usuario'];
   // $pwd = md5($_POST['pwd']); // encryptacion md5 
   $pwd = hash("sha256", md5($_POST['pwd']));
  

    if (empty($id)) {
        $sql = "INSERT INTO usuarios (nombres,apellidos,usr,pass) VALUES ('$nombres','$apellidos','$usuario','$pwd')";
        if ($conn->query($sql)) {
      
            echo "<script>
            
            alert('Datos Guardados correctamente');
            window.location.href= '../FormularioUsu.php';
            </script>";
           
            //header("Location../Index.php");
        } else {
        
        
            echo "<script>
            
            alert('Error al Guardar');
            window.location.href= '../FormularioUsu.php';
            </script>";
        
        }
    } else if (!empty($id)) {

        $sql = "UPDATE usuarios set nombres = '$nombres', apellidos='$apellidos',usr='$usuario',pass='$pwd' where id=$id;";
        if ($conn->query($sql)) {
            echo "<script>
            
            alert('Usuario Actualizado correctamente');
            window.location.href= '../ListaUsu.php';
            </script>";
        } else {
            echo "<script>
            
            alert('Error al Actualizar Usuario');
            window.location.href= '../ListaUsu.php';
            </script>";
        }
    }


    

    $conn->close();
} else if (isset($_POST['Enviar']) and $_POST['Enviar'] === "Eliminar") {

    $id = $_POST['id'];
    $sql = "DELETE FROM usuarios WHERE id = $id;";

    if ($conn->query($sql)) {
        echo "<script>
        
        alert('Usuario Eliminado correctamente');
        window.location.href= '../ListaUsu.php';
        </script>";
    } else {
        echo "<script>
        
        alert('Error al Elimir Usuario');
        window.location.href= '../ListaUsu.php';
        </script>";
    }

}