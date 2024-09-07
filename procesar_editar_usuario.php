<?php
require 'usuario.php';
require 'conexion.php';

$usuario = new Usuario($conexion);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];

    // Procesar la nueva foto si se sube una
    $foto = $_FILES['foto']['name'];
    if (!empty($foto)) {
        $rutaDestino = "fotografias_subidas/" . basename($foto);
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino)) {
            echo "La foto se ha subido correctamente.";
        } else {
            echo "Error al subir la foto.";
        }
    } else {
        // Si no se sube nueva foto, mantenemos la actual
        $foto = null;
    }

    // Actualizar los datos del usuario, incluido el manejo de la foto
    if ($usuario->actualizarUsuario($id, $nombre, $direccion, $telefono, $foto)) {
        header("Location: listar_usuarios.php");
        exit();
    } else {
        echo "Error al actualizar el usuario.";
    }
}
?>
