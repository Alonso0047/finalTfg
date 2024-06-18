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

// Obtener el ID del producto desde la URL y escapar caracteres especiales
$id_producto = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id_producto > 0) {
    // Consulta para obtener los detalles del producto
    $sql = "SELECT * FROM productos WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id_producto);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Obtener los detalles del producto
        $producto = $result->fetch_assoc();
    } else {
        echo "Producto no encontrado.";
        exit();
    }
    $stmt->close();
} else {
    echo "ID de producto no válido.";
    exit();
}

// Cerrar la conexión
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
		<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;600;700&display=swap" rel="stylesheet" />
		<link rel="stylesheet" href="../estilos/estilosPrincipales.css" />
		<link rel="stylesheet" href="../estilos/tabs.css" />
		<script src="../src/main.js" defer></script>
		<script src="../src/producto.js" defer></script>
		<script src="../src/tabs.js" defer></script>
		<script src="../src/enviarPedido.js" defer></script>
		
		
		<title>Página de Tienda</title>
	</head>
	<body>
		<div class="contenedor">
			<header class="header">
				<h1 class="header__logo">Tienda</h1>
				<nav class="header__menu">
					<a href="#" class="header__link">Categorias</a>
					<a href="#" class="header__link" data-accion="abrir-carrito">Mi Carrito</a>
					<a href="../incioSesion/PaginaRegistro.html" class="header__link">Mi Cuenta</a>
				</nav>
			</header>
			<main>
				<div class="breadcrumbs">
					<a href="../html/Index.html" class="breadcrumbs__link">Inicio</a>
					<div class="breadcrumbs__separador">
						<svg
							xmlns="http://www.w3.org/2000/svg"
							fill="currentColor"
							viewBox="0 0 16 16"
							class="breadcrumbs__svg"
						>
							<path
								fill-rule="evenodd"
								d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"
							/>
						</svg>
					</div>
					<a href="/" class="breadcrumbs__link">Tennis</a>
					<div class="breadcrumbs__separador">
						<svg
							xmlns="http://www.w3.org/2000/svg"
							fill="currentColor"
							viewBox="0 0 16 16"
							class="breadcrumbs__svg"
						>
							<path
								fill-rule="evenodd"
								d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"
							/>
						</svg>
					</div>
					<p href="/" class="breadcrumbs__active">Converse</p>
				</div>

				<div class="producto" id="producto" data-producto-id="<?php echo htmlspecialchars($producto['id_producto'], ENT_QUOTES, 'UTF-8'); ?>">
					<div class="producto__thumbs">
						<img src="./img/thumbs/negro.jpg" alt="" class="producto__thumb-img" />
						<img src="./img/thumbs/1.jpg" alt="" class="producto__thumb-img" />
						<img src="./img/thumbs/2.jpg" alt="" class="producto__thumb-img" />
						<img src="./img/thumbs/3.jpg" alt="" class="producto__thumb-img" />
						<img src="./img/thumbs/4.jpg" alt="" class="producto__thumb-img" />
					</div>
					<div class="producto__contenedor-imagen">
						<img src="<?php echo htmlspecialchars($producto['imagen_url'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($producto['nombre'], ENT_QUOTES, 'UTF-8'); ?>" alt="" class="producto__imagen" />
					</div>
					<div class="producto__contenedor-info">
						<div class="producto__estrellas">
							<div class="producto__estrella">
								<svg
									xmlns="http://www.w3.org/2000/svg"
									fill="currentColor"
									class="bi bi-star-fill"
									viewBox="0 0 16 16"
								>
									<path
										d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
									/>
								</svg>
							</div>
							<div class="producto__estrella">
								<svg
									xmlns="http://www.w3.org/2000/svg"
									fill="currentColor"
									class="bi bi-star-fill"
									viewBox="0 0 16 16"
								>
									<path
										d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
									/>
								</svg>
							</div>
							<div class="producto__estrella">
								<svg
									xmlns="http://www.w3.org/2000/svg"
									fill="currentColor"
									class="bi bi-star-fill"
									viewBox="0 0 16 16"
								>
									<path
										d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
									/>
								</svg>
							</div>
							<div class="producto__estrella">
								<svg
									xmlns="http://www.w3.org/2000/svg"
									fill="currentColor"
									class="bi bi-star-fill"
									viewBox="0 0 16 16"
								>
									<path
										d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
									/>
								</svg>
							</div>
							<div class="producto__estrella">
								<svg
									xmlns="http://www.w3.org/2000/svg"
									fill="currentColor"
									class="bi bi-star-fill"
									viewBox="0 0 16 16"
								>
									<path
										d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
									/>
								</svg>
							</div>
						</div>
						<h1 class="producto__nombre"><?php echo htmlspecialchars($producto['nombre'], ENT_QUOTES, 'UTF-8'); ?></h1>
						<p class="producto__descripcion">Aqui vendemos productos bastante buenos de mucha calidad
								envios rapidos y si tiene alguna queja puedes mandarnos un mensaje en nuestra pagina principal
								ofrecemos mucha variedad de productos</p>
						<div class="producto__contenedor-propiedad">
							<p class="producto__propiedad">Precio</p>
							<p class="producto__precio">$<?php echo number_format($producto['precio'], 2); ?></p>
						</div>
						
						
						<div class="producto__contenedor-propiedad">
							<p class="producto__propiedad">Cantidad</p>
							<button class="producto__btn-cantidad" id="disminuir-cantidad">
								<svg
									xmlns="http://www.w3.org/2000/svg"
									width="16"
									height="16"
									fill="currentColor"
									viewBox="0 0 16 16"
								>
									<path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" />
								</svg>
							</button>
							<input type="text" id="cantidad" value="1" class="producto__cantidad" />
							<button class="producto__btn-cantidad" id="incrementar-cantidad">
								<svg
									xmlns="http://www.w3.org/2000/svg"
									width="16"
									height="16"
									fill="currentColor"
									viewBox="0 0 16 16"
								>
									<path
										d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"
									/>
								</svg>
							</button>
						</div>
						<button type="submit" class="producto__btn-carrito" id="agregar-al-carrito">
							Agregar al carrito
						</button>
					</div>
				</div>

				<div class="mas-informacion" id="mas-informacion">
					<div class="tabs">
						<button class="tabs__button tabs__button--active" data-tab="caracteristicas">
							Caracteristicas
						</button>
						<button class="tabs__button" data-tab="reseñas">Reseñas</button>
						<button class="tabs__button" data-tab="envio">Envio</button>
					</div>
					<div class="tab tab--active" id="caracteristicas">
						<h3 class="tab__titulo">Caracteristicas</h3>
						<ul class="tab__lista">
							<li>Nunc ornare ex at diam fermentum scelerisque.</li>
							<li>Integer vehicula nisl in sem faucibus, ac tincidunt magna dapibus.</li>
							<li>Integer vel magna eget ipsum laoreet lobortis.</li>
							<li>Phasellus viverra dui ut lorem tempus eleifend.</li>
							<li>Maecenas dictum lacus et condimentum aliquam.</li>
						</ul>
					</div>
					<div class="tab" id="reseñas">
						<h3 class="tab__titulo">Reseñas</h3>
						<div class="reseña">
							<img src="./img/users/1.jpg" class="reseña__foto" alt="" />
							<div class="reseña__info">
								<div class="reseña__estrellas">
									<div class="reseña__estrella">
										<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
											<path
												d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
											/>
										</svg>
									</div>
									<div class="reseña__estrella">
										<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
											<path
												d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
											/>
										</svg>
									</div>
									<div class="reseña__estrella">
										<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
											<path
												d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
											/>
										</svg>
									</div>
									<div class="reseña__estrella">
										<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
											<path
												d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
											/>
										</svg>
									</div>
									<div class="reseña__estrella">
										<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
											<path
												d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
											/>
										</svg>
									</div>
								</div>
								<p class="reseña__fecha">31 de Mayo de 2022</p>
								<p class="reseña__texto">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sed nunc dapibus,
									fringilla felis nec, consequat ipsum. Maecenas aliquam metus neque, a lobortis justo
									suscipit eu. Quisque sit amet orci at tortor fermentum suscipit bibendum in libero.
									Duis rhoncus massa blandit nunc gravida, at euismod augue congue.
								</p>
							</div>
						</div>
						<div class="reseña">
							<img src="./img/users/2.jpg" alt="" class="reseña__foto" />
							<div class="reseña__info">
								<div class="reseña__estrellas">
									<div class="reseña__estrella">
										<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
											<path
												d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
											/>
										</svg>
									</div>
									<div class="reseña__estrella">
										<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
											<path
												d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
											/>
										</svg>
									</div>
									<div class="reseña__estrella">
										<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
											<path
												d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
											/>
										</svg>
									</div>
									<div class="reseña__estrella">
										<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
											<path
												d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
											/>
										</svg>
									</div>
									<div class="reseña__estrella">
										<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
											<path
												d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
											/>
										</svg>
									</div>
								</div>
								<p class="reseña__fecha">31 de Mayo de 2022</p>
								<p class="reseña__texto">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
							</div>
						</div>
						<div class="reseña">
							<img src="./img/users/3.jpg" alt="" class="reseña__foto" />
							<div class="reseña__info">
								<div class="reseña__estrellas">
									<div class="reseña__estrella">
										<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
											<path
												d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
											/>
										</svg>
									</div>
									<div class="reseña__estrella">
										<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
											<path
												d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
											/>
										</svg>
									</div>
									<div class="reseña__estrella">
										<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
											<path
												d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
											/>
										</svg>
									</div>
									<div class="reseña__estrella">
										<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
											<path
												d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
											/>
										</svg>
									</div>
									<div class="reseña__estrella">
										<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
											<path
												d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
											/>
										</svg>
									</div>
								</div>
								<p class="reseña__fecha">31 de Mayo de 2022</p>
								<p class="reseña__texto">
									Integer vel nisi massa. Pellentesque ligula nulla, pretium hendrerit massa quis,
									tempus consequat lectus. Nulla facilisi. Etiam ipsum felis, euismod eget volutpat
									tristique, consequat at lorem.
								</p>
							</div>
						</div>
					</div>
					<div class="tab" id="envio">
						<h3 class="tab__titulo">Envio</h3>
						<p class="tab__parrafo">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent consectetur hendrerit
							nunc, nec aliquet nisi consequat nec. Fusce porttitor non quam vitae venenatis. Sed maximus
							lacus at elit consequat, nec finibus nisl commodo. Vestibulum vitae urna quis nisi mollis
							elementum non ac sem.
						</p>
						<p class="tab__parrafo">
							Proin ut tristique est. Curabitur volutpat mi quam, et tristique ipsum dignissim ut. Nam
							bibendum feugiat turpis sit amet auctor. Cras efficitur ullamcorper ligula. Sed nec tellus
							odio. Cras eget fermentum odio. Maecenas molestie nulla lorem, a pulvinar risus malesuada
							et.
						</p>
					</div>
				</div>
			</main>
		</div>

		<div class="notificacion" id="notificacion">
			<p class="notificacion__titulo">Agregado al carrito</p>
			<img src="./img/thumbs/1.jpg" alt="" class="notificacion__thumb" />
			<a href="#" class="notificacion__link" data-accion="abrir-carrito">Ver carrito</a>
		</div>

		<div class="carrito" id="carrito">
			<div class="carrito__overlay">
				<div class="carrito__contenedor">
					<div class="carrito__header">
						<h4 class="carrito__titulo">Carrito</h4>
						<button class="carrito__btn-cerrar" data-accion="cerrar-carrito">
							<svg
								xmlns="http://www.w3.org/2000/svg"
								width="16"
								height="16"
								fill="currentColor"
								viewBox="0 0 16 16"
							>
								<path
									d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"
								/>
							</svg>
						</button>
					</div>
					<div class="carrito__body">
						<p class="carrito__aviso-sin-productos"></p>
						<!-- <div class="carrito__producto">
							<div class="carrito__producto-info">
								<img src="./img/tennis/1.jpg" alt="" class="carrito__thumb" />
								<div>
									<p class="carrito__producto-nombre">
										<span class="carrito__producto-cantidad">1 x </span>Lorem Ipsum Dolot Asimmet
									</p>
									<p class="carrito__producto-propiedades">
										Tamaño:<span>2,5</span> Color:<span>Rojo</span>
									</p>
								</div>
							</div>
							<div class="carrito__producto-contenedor-precio">
								<button class="carrito__btn-eliminar-item" data-accion="eliminar-item-carrito">
									<svg
										xmlns="http://www.w3.org/2000/svg"
										width="16"
										height="16"
										fill="currentColor"
										viewBox="0 0 16 16"
									>
										<path
											d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"
										/>
									</svg>
								</button>
								<p class="carrito__producto-precio">$500.00</p>
							</div>
						</div> -->
					</div>
					<div class="carrito__footer">
						<div class="carrito__contenedor-total">
							<div>
								<p class="carrito__label">Total:</p>
								<p class="carrito__total">$0.00</p>
							</div>
							<button class="carrito__btn-comprar" id="carrito__btn-comprar" onclick="location.href='../html/MetodoPago.html'">Comprar</button>
						</div>
						<div class="carrito__contenedor-btn-regresar" data-accion="cerrar-carrito">
							<button class="carrito__btn-regresar">Regresar a la tienda</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</body>
</html>

<!-- onclick="location.href='../html/MetodoPago.html'" -->

