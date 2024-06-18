<?php
session_start();

$host = 'localhost';
$db = 'tienda';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si hay una sesión de usuario activa y obtener el usuario_id
if (!isset($_SESSION['usuario_id'])) {
    header("Location: inicioSesion.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// Verificar la existencia del usuario en la base de datos
$stmt = $conn->prepare("SELECT id FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    header("Location: inicioSesion.php");
    exit();
}

$stmt->bind_result($usuario_id);
$stmt->fetch();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Aquí deberías obtener el último id_pedido insertado en la tabla pedidos
    $ultimo_id_pedido = obtenerUltimoIdPedido($conn); // Implementación de esta función más adelante

    $numero_tarjeta = $_POST['card-number'];
    $fecha_expiracion = $_POST['expiration-date'];
    $codigo_seguridad = $_POST['security-code'];
    $titular_tarjeta = $_POST['card-holder'];

    if (empty($numero_tarjeta) || empty($fecha_expiracion) || empty($codigo_seguridad) || empty($titular_tarjeta)) {
        die("Por favor, complete todos los campos.");
    }

    // Preparar la consulta SQL para insertar en la tabla tarjeta
    $sql = "INSERT INTO tarjeta (id_pedido, numero_tarjeta, fecha_caducidad, codigo_seguridad, titular_tarjeta) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $ultimo_id_pedido, $numero_tarjeta, $fecha_expiracion, $codigo_seguridad, $titular_tarjeta);

    // Ejecutar la consulta preparada
    if ($stmt->execute()) {
        echo "Tarjeta registrada correctamente.";
    } else {
        echo "Error al registrar la tarjeta: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

// Función para obtener el último id_pedido insertado en la tabla pedidos
function obtenerUltimoIdPedido($conn) {
    $sql = "SELECT MAX(id_pedido) AS ultimo_id FROM pedidos";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['ultimo_id'];
    } else {
        // Manejar el caso cuando no hay pedidos aún
        return 0; // O cualquier valor por defecto según tu lógica de negocio
    }
}
?>
