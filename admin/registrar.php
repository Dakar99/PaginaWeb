<?php

include('../conexion/conn.php');

// Incluir la conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'systemweb');

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Verifica si el formulario ha sido enviado
if (isset($_POST['agregar_usuario'])) {
    // Recoger los valores del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha_Nacimiento = $_POST['fecha_Nacimiento'];
    $correo = $_POST['correo'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT); // Cifrado de la contraseña
    $descripcion = $_POST['descripcion'];
    $tipo = $_POST['tipo'];

    // Insertar el nuevo usuario en la base de datos
    $sql = "INSERT INTO usuarios (nombre, apellido, fecha_Nacimiento, correo, contrasena, descripcion, tipo)
            VALUES ('$nombre', '$apellido', '$fecha_Nacimiento', '$correo', '$contrasena', '$descripcion', '$tipo')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Nuevo usuario agregado correctamente.";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Usuario</title>
    <link rel="stylesheet" href="../css/registrar.css">
</head>
<body>

    <div class="form-container">
        <h2>Agregar Nuevo Usuario</h2>
        <form action="../admin/admin.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required><br>

            <label for="fecha_Nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_Nacimiento" name="fecha_Nacimiento" required><br>

            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required><br>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required><br>

            <label for="descripcion">Decripción:</label>
            <input type="text" id="descripcion" name="descripcion" required><br>

            <label for="tipo">Tipo de Usuario:</label>
            <select id="tipo" name="tipo" required>
                <option value="Administrador">Administrador</option>
                <option value="Atleta">Atleta</option>
                <option value="Profesional de la salud">Profesional de la salud</option>
            </select><br>

            <input type="submit" name="agregar_usuario" value="Agregar Usuario">
            
        </form>
    </div>

</body>
</html>