<?php
// Incluir la conexión a la base de datos
include('../conexion/conn.php');
// Incluir la conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'systemweb');

// Verificar si el ID del usuario está presente en la URL
if (isset($_GET['usuario_id'])) {
    $usuario_id = $_GET['usuario_id'];

    // Obtener los datos del usuario de la base de datos
    $sql = "SELECT * FROM usuarios WHERE usuario_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se ha encontrado el usuario
    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
    } else {
        echo "Usuario no encontrado";
        exit();
    }
} else {
    echo "ID de usuario no especificado";
    exit();
}

// Procesar el formulario de edición
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha_nacimiento = $_POST['fecha_Nacimiento'];
    $correo = $_POST['correo'];
    $tipo = $_POST['tipo'];

    $sql = "UPDATE usuarios SET nombre=?, apellido=?, fecha_Nacimiento=?, correo=?, tipo=? WHERE usuario_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $nombre, $apellido, $fecha_nacimiento, $correo, $tipo, $usuario_id);

    if ($stmt->execute()) {
        echo "Usuario actualizado correctamente.";
        header("Location: index.php");
        exit();
    } else {
        echo "Error al actualizar el usuario.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="../css/editar.css"> <!-- Vincula el archivo CSS -->
</head>
<body>

    <div class="form-container">
        <h2>Editar Usuario</h2>
        <form action="editar_usuario.php?usuario_id=<?php echo $usuario_id; ?>" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" value="<?php echo htmlspecialchars($usuario['apellido']); ?>" required>

            <label for="fecha_Nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_Nacimiento" name="fecha_Nacimiento" value="<?php echo htmlspecialchars($usuario['fecha_Nacimiento']); ?>" required>

            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" value="<?php echo htmlspecialchars($usuario['correo']); ?>" required>

            <label for="tipo">Tipo de Usuario:</label>
            <select id="tipo" name="tipo" required>
                <option value="Administrador" <?php if($usuario['tipo'] == 'Administrador') echo 'selected'; ?>>Administrador</option>
                <option value="Atleta" <?php if($usuario['tipo'] == 'Atleta') echo 'selected'; ?>>Atleta</option>
                <option value="Profesional de la salud" <?php if($usuario['tipo'] == 'Profesional de la salud') echo 'selected'; ?>>Profesional de la salud</option>
            </select>

            <input type="submit" value="Actualizar Usuario" class="btn-primary">
        </form>
    </div>

</body>
</html>