<?php 
require 'usuario.php';
require 'conexion.php';

$usuario = new Usuario($conexion);
$usuarios = $usuario->listarUsuarios();

$title = "Lista usuarios";
include 'header.php';
?>

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header text-center">
            <h1>Lista de Usuarios</h1>
        </div>
        <div class="card-body">
            <?php if (!empty($usuarios)) { ?>  <!-- Verificamos si el array no está vacío -->
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Foto</th> <!-- Nueva columna para la foto -->
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario) { ?>
                    <tr>
                        <td><?php echo $usuario['id']; ?></td>
                        <td><?php echo $usuario['nombre']; ?></td>
                        <td><?php echo $usuario['direccion']; ?></td>
                        <td><?php echo $usuario['telefono']; ?></td>
                        <td>
                            <?php if ($usuario['foto']) { ?>
                                <img src="fotografias_subidas/<?php echo $usuario['foto']; ?>" alt="Foto" width="50">
                            <?php } else { ?>
                                No tiene foto
                            <?php } ?>
                        </td>
                        <td>
                            <a href="editar_usuario.php?id=<?php echo $usuario['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="eliminar_usuario.php?id=<?php echo $usuario['id']; ?>" class="btn btn-sm btn-danger">Eliminar</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php } else { ?>
                <p class="text-center">No hay usuarios registrados.</p>
            <?php } ?>
        </div>
        <div class="card-footer text-center">
            <a href="agregar_usuario.php" class="btn btn-primary">Agregar Usuario</a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
