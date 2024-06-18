<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST['id_producto'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $imagen_url = $_POST['imagen_url']; // Verifica que el campo 'imagen_url' se esté recibiendo

    $producto = [
        'id_producto' => $id_producto,
        'nombre' => $nombre,
        'precio' => $precio,
        'cantidad' => $cantidad,
        'imagen_url' => $imagen_url, // Asegúrate de que esté siendo almacenado
        'total' => $precio * $cantidad
    ];

    // Inicializar el carrito si no existe
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Añadir el producto al carrito
    $_SESSION['carrito'][$id_producto] = $producto;

    // Redirigir de vuelta a la página de productos con un mensaje de éxito
    $mensaje = "Producto añadido al carrito: $nombre (Cantidad: $cantidad, Total: $" . $producto['total'] . ")";
    echo $mensaje;
}
?>
