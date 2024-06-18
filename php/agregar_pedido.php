<?php
session_start();

// Conexión a la base de datos
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
    echo "Debe iniciar sesión para realizar una compra.";
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// Verificar la existencia del usuario en la base de datos
$stmt = $conn->prepare("SELECT id FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    echo "Usuario no encontrado.";
    exit();
}

$stmt->bind_result($usuario_id);
$stmt->fetch();
$stmt->close();

// Obtener el carrito desde la solicitud POST (debe venir desde tu formulario o aplicación)
$carrito = isset($_POST['carrito']) ? json_decode($_POST['carrito'], true) : [];

if (empty($carrito)) {
    echo "El carrito está vacío.";
    exit();
}

// Preparar la consulta para insertar en pedidos
$sql = "INSERT INTO pedidos (nombre_producto, precio_producto, cantidad_productos, fecha_registro, id_usuario) VALUES (?, ?, ?, NOW(), ?)";
$stmt = $conn->prepare($sql);

foreach ($carrito as $producto) {
    $nombre = $producto['nombre'];
    $precio = $producto['precio'];
    $cantidad = $producto['cantidad'];

    // Bind de parámetros y ejecución para cada producto
    $stmt->bind_param("sdis", $nombre, $precio, $cantidad, $usuario_id);

    if ($stmt->execute()) {
        echo "Pedido registrado correctamente para el producto: " . $nombre . "<br>";
    } else {
        echo "Error al registrar el pedido para el producto: " . $nombre . "<br>";
        echo "Error: " . $stmt->error;
    }
}

$stmt->close();
$conn->close();

echo "Compra realizada con éxito.";
?>
