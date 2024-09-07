<?php
require 'usuario.php';
require 'conexion.php';

$usuario = new Usuario($conexion);

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($usuario->eliminarUsuario($id)) {
        header("Location: listar_usuarios.php");
        exit();
    } else {
        echo "Error al eliminar el usuario.";
    }
} else {
    echo "ID de usuario no especificado.";
}
?>
