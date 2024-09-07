<?php 
include('conexion.php');  // Incluir la conexión a la base de datos
include('usuario.php');   // Incluir la clase Usuario
    
$id = $_GET["id"];
$usuario = new Usuario($conexion);  // Pasar la conexión a la clase Usuario
$usuario = $usuario->obtenerUnUsuario($id);  // Obtener los datos del usuario
$title = "Editar usuario";
include 'header.php';
?>

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header text-center">
            <h2>Editar Usuario</h2>
        </div>
        <div class="card-body">
            <form action="procesar_editar_usuario.php" method="post" enctype="multipart/form-data" class="w-75 mx-auto">
                <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="<?php echo $usuario['nombre']; ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" name="direccion" id="direccion" value="<?php echo $usuario['direccion']; ?>" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" name="telefono" id="telefono" value="<?php echo $usuario['telefono']; ?>" class="form-control">
                </div>

                <!-- Mostrar la foto actual -->
                <div class="mb-3">
                    <label for="fotoActual" class="form-label">Foto Actual</label><br>
                    <?php if ($usuario['foto']) { ?>
                        <img src="fotografias_subidas/<?php echo $usuario['foto']; ?>" alt="Foto" width="100">
                    <?php } else { ?>
                        <p>No tiene foto.</p>
                    <?php } ?>
                </div>

                <!-- Campo para subir nueva foto -->
                <div class="mb-3">
                    <label for="foto" class="form-label">Cambiar Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
        <div class="card-footer text-center">
            <a href="listar_usuarios.php" class="btn btn-secondary">Volver a la Lista de Usuarios</a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
