<?php
// Conexión a la base de datos (idealmente, deberías tener un archivo de conexión compartido para evitar repetición)
$host = 'localhost';
$db = 'tienda';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Validar entradas
    if (empty($correo) || empty($contraseña)) {
        die("Por favor, complete todos los campos.");
    }

    // Verificar el usuario en la base de datos
    $stmt = $conn->prepare("SELECT id, contraseña_hash FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($usuario_id, $contraseña_hash);
        $stmt->fetch();

        // Verificar la contraseña
        if (password_verify($contraseña, $contraseña_hash)) {
            // Generar un token de sesión
            $token = bin2hex(random_bytes(16));
            $fecha_expiracion = date('Y-m-d H:i:s', strtotime('+1 hour'));

            // Insertar la sesión en la base de datos
            $stmt = $conn->prepare("INSERT INTO sesiones (usuario_id, token, fecha_expiracion) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $usuario_id, $token, $fecha_expiracion);

            if ($stmt->execute()) {
                // Guardar el token en la sesión
                $_SESSION['token'] = $token;
                $_SESSION['usuario_id'] = $usuario_id; // Establecer el ID de usuario en la sesión
                header("Location: biemvenido.php"); // Redirigir a la página de dashboard o a donde sea necesario
                exit();
            } else {
                echo "Error al crear sesión: " . $stmt->error;
            }
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Correo electrónico no encontrado.";
    }

    $stmt->close();
}

$conn->close();
?>
