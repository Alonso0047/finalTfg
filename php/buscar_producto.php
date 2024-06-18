<?php
session_start();

// Conexión a la base de datos
$servername = "localhost"; 
$username = "root";
$password = "";
$database = "tienda";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el nombre del producto enviado desde el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_producto = $_POST["nombre_producto"];

    // Consulta para buscar productos que coincidan con el nombre
    $sql = "SELECT * FROM productos WHERE nombre LIKE '%$nombre_producto%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Si se encuentran productos, pasar sus detalles a la página de productos
        $productos = [];
        while ($row = $result->fetch_assoc()) {
            $productos[] = $row;
        }

        // Almacenar productos en la sesión
        $_SESSION['productos'] = $productos;

        // Serializar el array de productos para pasar como parámetro en la URL
        $productos_serializados = urlencode(serialize($productos));
        header("Location: paginaproductos.php?productos=$productos_serializados");
        exit();
    } else {
        echo "Producto no encontrado.";
    }
}

// Cerrar la conexión
$conn->close();
?>


