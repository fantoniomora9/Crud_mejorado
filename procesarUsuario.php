<?php 
require 'usuario.php';
require 'conexion.php';
$usuario = new Usuario($conexion);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];

    // Procesar la imagen que el usuario ha subido
    $foto = $_FILES['foto']['name'];
    if (!empty($foto)) {
        $rutaDestino = "fotografias_subidas/" . basename($foto); // Ruta donde se guardará la imagen

        // Mover el archivo subido al directorio "fotografias_subidas"
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino)) {
            echo "La foto se ha subido correctamente.";
        } else {
            echo "Error al subir la foto.";
        }
    } else {
        $rutaDestino = null; // Si no se sube una imagen, se guarda como null
    }

    // Llamar al método agregarUsuario con la foto
    if ($usuario->agregarUsuario($nombre, $direccion, $telefono, $foto)) {
        header("Location: listar_usuarios.php");
        exit();
    } else {
        echo "Error al agregar el usuario.";
    }
}
?>
