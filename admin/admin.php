<?php
// Incluir la conexión a la base de datos
include('..//conexion/conn.php');

// Incluir la conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'systemweb');

// Obtener todos los usuarios
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Administrador</title>
    <link rel="stylesheet" href="../css/admin.css"> <!-- Vincula el archivo CSS -->
</head>
<body>

    <!-- Barra Lateral (Sidebar) -->
    <div class="sidebar">
        <h2>Administrador</h2>
        <ul>
            <li><a href="../admin/registrar.php">Agregar Usuario</a></li>
            <li><a href="../login/login.html">Cerrar Sesión</a></li>
        </ul>
    </div>

    <!-- Contenido Principal -->
    <div class="main-content">
        <h2>Gestión de Usuarios</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Descripción</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['usuario_id']; ?></td>
                        <td><?php echo $row['nombre']; ?></td>
                        <td><?php echo $row['apellido']; ?></td>
                        <td><?php echo $row['correo']; ?></td>
                        <td><?php echo $row['descripcion']; ?></td>
                        <td><?php echo $row['tipo']; ?></td>
                        <td>
                            <!-- Botón para editar usuario -->
                            <a href="../admin/editar.php?php echo $row['usuario_id']; ?>" class="btn btn-edit">Editar</a>

                            <!-- Botón para eliminar usuario -->
                            <a href="eliminar_usuario.php?usuario_id=<?php echo $row['usuario_id']; ?>" class="btn btn-delete" onclick="return confirm('¿Estás seguro de eliminar este usuario?');">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>