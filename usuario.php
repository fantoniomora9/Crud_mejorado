<?php
class Usuario {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // Método para listar todos los usuarios
    public function listarUsuarios() {
        $usuarios = array();
        $query = "SELECT * FROM usuario";
        $resultado = $this->conexion->query($query);

        if ($resultado) {
            while ($fila = $resultado->fetch_assoc()) {
                $usuarios[] = $fila;
            }
            $resultado->free();
        } else {
            echo "Error al listar usuarios: " . $this->conexion->error;
        }

        return $usuarios;
    }

    // Método para agregar un nuevo usuario
    public function agregarUsuario($nombre, $direccion, $telefono, $foto) {
        $query = "INSERT INTO usuario (nombre, direccion, telefono, foto) VALUES (?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("ssss", $nombre, $direccion, $telefono, $foto);
        return $stmt->execute();
    }

    // Método para obtener los datos de un usuario por su ID
    public function obtenerUnUsuario($id) {
        $query = "SELECT * FROM usuario WHERE id = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    // Método para actualizar los datos de un usuario (incluye la opción de cambiar la foto)
    public function actualizarUsuario($id, $nombre, $direccion, $telefono, $foto = null) {
        if ($foto) {
            // Si se subió una nueva foto, actualiza también el campo de la foto
            $query = "UPDATE usuario SET nombre = ?, direccion = ?, telefono = ?, foto = ? WHERE id = ?";
            $stmt = $this->conexion->prepare($query);
            $stmt->bind_param("ssssi", $nombre, $direccion, $telefono, $foto, $id);
        } else {
            // Si no se subió una nueva foto, no actualiza el campo de la foto
            $query = "UPDATE usuario SET nombre = ?, direccion = ?, telefono = ? WHERE id = ?";
            $stmt = $this->conexion->prepare($query);
            $stmt->bind_param("sssi", $nombre, $direccion, $telefono, $id);
        }

        return $stmt->execute();
    }

    // Método para eliminar un usuario por su ID
    public function eliminarUsuario($id) {
        $query = "DELETE FROM usuario WHERE id = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
