<?php
session_start();

// Verificar si hay productos en la sesión
if (!isset($_SESSION['productos'])) {
    echo "No hay productos para mostrar.";
    exit();
}

$productos = $_SESSION['productos'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>AutoExpress - Productos Encontrados</title>
    <link rel="stylesheet" type="text/css" href="../estilos/pagina1.css">
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Obtener los productos de PHP
            const productos = <?php echo json_encode($productos); ?>;
            const contenedorPrincipal = document.getElementById('contenedorPrincipal');

            // Limpiar el contenedor principal
            contenedorPrincipal.innerHTML = '';

            // Iterar a través de los productos y crear elementos
            productos.forEach((item) => {
                const nuevoElemento = document.createElement('a');
                nuevoElemento.href = `productodetalle.php?id=${item.id_producto}`;
                const plantilla = `
                    <div class="contenedor-secundario">
                        <img class="imagen" src="${item.imagen_url}" alt="${item.nombre}">
                        <h3 class="precio">$${parseFloat(item.precio).toFixed(2)}</h3>
                        <p class="descripcion">${item.nombre}</p>
                    </div>
                `;

                nuevoElemento.innerHTML = plantilla;
                nuevoElemento.classList.add('editar-a');

                // Añadir el nuevo elemento al contenedor principal
                contenedorPrincipal.appendChild(nuevoElemento);
            });
        });
    </script>
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo-container">
                <h1 class="logo">Auto<span class="logo-accent">Express</span></h1>
            </div>
            <form action="../php/buscar_producto.php" method="POST">
                <input type="text" name="nombre_producto" placeholder="Buscar productos...">
                <button type="submit">Buscar</button>
            </form>
            <nav>
                <ul>
                    <li><a href="#">Inicio</a></li>
                    <li><a href="#">Productos</a></li>
                    <li><a href="#">Contacto</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <div class="contenedor-principal" id="contenedorPrincipal">
        <!-- Aquí se cargarán los productos dinámicamente -->
    </div>
</body>
</html>
