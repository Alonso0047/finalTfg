<?php
// Conexión a la base de datos
$host = 'localhost';
$db = 'tienda';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Validar entradas
    if (empty($nombre) || empty($correo) || empty($contraseña)) {
        die("Por favor, complete todos los campos.");
    }

    // Hash de la contraseña
    $contraseña_hash = password_hash($contraseña, PASSWORD_BCRYPT);

    // Insertar el usuario en la base de datos
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, correo, contraseña_hash) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $correo, $contraseña_hash);

    if ($stmt->execute()) {
        echo "Registro exitoso. Ahora puede iniciar sesión.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
