<?php
// Datos de conexión a la base de datos
$servidor = "localhost";   // El servidor MySQL (localhost si es local)
$usuario = "root";         // Nombre de usuario (por defecto es 'root')
$contraseña = "";          // Contraseña de MySQL (por defecto en XAMPP es vacío)
$base_de_datos = "systemweb";  // Nombre de la base de datos que quieres probar

// Crear la conexión
$conn = new mysqli($servidor, $usuario, $contraseña, $base_de_datos);

// Verificar la conexión
// if ($conn->connect_error) {
//     // Si la conexión falla
//     die("Conexión fallida: " . $conn->connect_error);
// } else {
//     // Si la conexión es exitosa
//     echo "Conexión exitosa con la base de datos: " . $base_de_datos;
// }

// Cerrar la conexión
$conn->close();
?>