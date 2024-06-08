-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-06-2024 a las 18:15:06
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `nombre_cliente` varchar(100) NOT NULL,
  `direccion_envio` varchar(255) NOT NULL,
  `correo_cliente` varchar(100) NOT NULL,
  `telefono_cliente` varchar(20) DEFAULT NULL,
  `metodo_pago` varchar(50) NOT NULL,
  `cantidad_productos` int(11) NOT NULL,
  `fecha_pedido` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(5) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio` double NOT NULL,
   `stock` INT NOT NULL DEFAULT 0,
  `url_imagen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `precio`, `stock`, `url_imagen`) VALUES
(1, 'BREMBO P 50 067X Juego de pastillas de freno', 83.6, 34, 'https://m.media-amazon.com/images/I/81DG9ltPomL._AC_UF894,1000_QL80_.jpg'),
(2, 'BREMBO P 50 067 Juego de pastillas de freno', 37.52, 44, 'https://cdn-images.motor.es/image/m/1320w.webp/fotos-noticias/2020/05/cuanto-cuesta-cambiar-las-pastillas-de-freno-202067565-1589964915_1.jpg'),
(3, 'BOSCH 0 986 424 098 Juego de pastillas de freno', 16.25, 26, 'https://www.highmotor.com/wp-content/uploads/2018/07/discos-freno-tipos-5.jpg'),
(4, 'BREMBO P 50 045 Juego de pastillas de freno', 29.93, 74, 'https://www.endado.com/blog/wp-content/uploads/2014/08/pastillas-de-freno.jpg'),
(5, 'BOSCH 0 986 424 512 Juego de pastillas de freno', 18, 14, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS4ZNHaW2h1JDvG2p3w6o_-PA-o84AfVBUdMFECZkr5dl4VFI7fZzy9EAXh_ZPHoe0LVuA&usqp.jpg'),
(6, 'TRW DTEC COTEC GDB1736DTE Juego de pastillas de fr', 61.2, 33, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTdt0xrA2uiN0FBphaPBeqcYzkPIe7HnbRmUUQLx4YyLK0ngD1dkpzxCuHsSg7pal71SC4&usqp.jpg'),
(7, 'BREMBO P 28 023 Juego de pastillas de freno', 34.4, 95, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRBYcFRZsQr-4_g9Es86uXVZNzudHuAt0cA0EMRlkQrzssabRmBdYbVybNiYXGG3QHqqNc&usqp.jpg'),
(8, 'BREMBO P 85 069 Juego de pastillas de freno', 87.5, 244, 'https://desguaceslacabaña.com/blog/wp-content/uploads/2019/05/cambiar-pastillas-de-freno-2-572x286.png'),
(9, 'RIDEX 402B0257 Juego de pastillas de freno', 25.2, 456, 'https://cdn.club-magazin.autodoc.de/uploads/sites/11/2020/10/pastillas-de-freno-bosch.jpg'),
(10, 'TRW DTEC COTEC GDB1550DTE Juego de pastillas de fr', 52.65, 1, 'https://assets.web4u.valeoservice.com/d8/prod/s3fs-public/node/product/field_product_image/prod_popin_pc_vs_kpd.png'),
(11, 'MASTER-SPORT 13046072272-SET-MS Juego de pastillas', 38.97, 5, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQzpBDwp8eh9VVxnEShKGMGpj737px90Rft864OsbzRbATiw1iSbV8gEDMnxA1k4V7-DtA&usqp.jpg'),
(12, 'Castrol EDGE 5W-30 LL Aceite de Motor 5L', 48.45, 87, 'https://www.diariomotor.com/imagenes/2019/05/filtro-aceite.jpg'),
(13, 'MOTUL Aceite de Motor 8100 X-Cess, 5W40-5 L', 35.32, 55, 'https://cdn.club-magazin.autodoc.de/uploads/sites/11/2020/09/aspectos-tener-en-cuenta-para-elegir-un-filtro-de-aceite-adecuado.jpg'),
(14, 'REPSOL aceite lubricante sintético para coche ELIT', 32.2, 98, 'https://scdn.autoteiledirekt.de/catalog/categories/500x500/55.png'),
(15, 'Castrol , Aceite DE Motor Power1 4T 10w40 4 Litros', 37.8, 31, 'https://noticias.coches.com/wp-content/uploads/2016/01/filtros-de-aceite-diferentes-vehiculos-700x409.jpg'),
(16, 'Total Aceite Lubricante de Motor Total Quartz Ineo', 35.7, 77, 'https://www.espamovil.com/wp-content/uploads/2017/05/filtro-de-aceite-1024x768.jpg'),
(17, 'K&N Filters HP-2011 Filtro de aceite', 14.32, 12, 'https://www.rodi.es/blog/wp-content/uploads/2021/12/filtro-aceite-coche-motor-rodimotorservices.jpg'),
(18, 'MANN-FILTER W 610/4 Filtro de aceite', 9.25, 6, 'https://res.cloudinary.com/knfilters-com/image/upload/c_lpad,dpr_2.0,f_auto,q_auto/v1/media/wysiwyg/oil-filters/hero.jpg'),
(19, 'BOSCH F 026 407 233 Filtro de aceite', 12, 872, 'https://www.rodi.es/blog/wp-content/uploads/2018/01/filtros-coche-aceite-habitaculo-aire.jpg'),
(20, 'BOSCH F 026 407 015 Filtro de aceite', 9.12, 322, 'https://cdn.club-magazin.autodoc.de/uploads/sites/11/2020/09/mann-filter-filtro-de-aceite.jpg'),
(21, 'BOSCH 0 451 103 261 Filtro de aceite', 8.75, 7, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTgO8p6100m5J2wgowu_QrSL7z4YxECR1PTSItry6Trfa9U6gmFTQ9ijSpuvmO8FcxlksE&usqp.jpg'),
(22, 'BOSCH 0 451 103 369 Filtro de aceite', 12.45, 16, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTTISiS9-YyUajETp0xhE0s-QdoAn0m0Y0H8-q7PlNGGuFse7zUOMNFBK7YOo50vJIiUTo&usqp.jpg'),
(23, 'Neumático MICHELIN PILOT SPORT 4 225/45 R17 94 Y X', 105, 88, 'https://www.shutterstock.com/image-photo/car-tire-alurim-on-free-260nw-2254362809.jpg'),
(24, 'Neumático PIRELLI P ZERO 225/40 R18 92 Y KS XL', 105, 383, 'https://noticias.coches.com/wp-content/uploads/2018/05/neumaticos-en-fila.jpg'),
(25, 'Neumático MICHELIN PRIMACY 4 195/65 R15 91 V', 83.25, 566, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ1vl3XEMC5V7EnTpswGXGU3YKFKMMlEo5C6xjrUY9Dy6jL2kkAEu8uuQdL-8bHKxqoqsQ&usqp=.jpg'),
(26, 'Neumático MICHELIN PILOT SPORT CUP 2 CONNECT 225/4', 158.5, 332, 'https://previews.123rf.com/images/jackrust/jackrust1108/jackrust110800009/10182979-neum%C3%A1ticos-y-ruedas-de-coche.jpg'),
(27, 'Neumático NANKANG SPORTNEX NS-2R 195/50R15 86W XL', 78, 432, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ7KgbqaRjOQehGURfWu3KMPfjtaWYSVeiX-JLsV11Db_hTpvcqs_rYIHo1QTkxffdOcIY&usqp.jpg'),
(28, 'Michelin Pilot Sport Cup 2 225/40 R18 92Y XL neumá', 150, 93, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQq144xS_AvrlWLzvR-ay8Gp6QeNWK4SxGLJ2CmQISAtEHqLqhO_26BcFsXsGYrR1uaP2E&usqp.jpg'),
(29, 'Neumático GOODYEAR EAGLE F1 ASYMMETRIC 6 225/40 R1', 95.5, 84, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSZl0IPWA7zGIiiWEpOnUt9Lpn8V65uGIheoxpUeMm0uLTylUQfYTSZV1gZFiyTFn6uCSg&usqp.jpg'),
(30, 'Neumático MICHELIN PILOT SPORT 4 S 235/40 R21 105 ', 499.99, 37, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQJK0GpCPY1IxPVerpeZGPsQm7pdnvhiv7vTvR3jnh13zi3eNZJTzJU1TqYNxiNbZN0JIA&usqp.jpg'),
(31, 'NANKANG 195/55ZR15 89W XL NS-2R', 82.93, 68, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSFdlrtkVJvpsKxIhPPJZTuYuht42rz6lCtoypQDpVJY8p8n5nU1p0k5p6H-hev0AM6dj8&usqp.jpg'),
(32, 'TOYO 225/40ZR18 92Y XL PROXES R888R', 89.12, 25, 'https://s1.medias-norauto.es/images_produits/MICHELIN_Pilot_Sport_4_1/900x900/neumatico-michelin-pilot-sport-4-205-55-r16-91-y--75420.jpg'),
(33, 'Neumático GOODYEAR EFFICIENTGRIP PERFORMANCE 2 195', 73.5, 29, 'https://s1.medias-norauto.es/images_produits/tyre_comm_txt-michelin_pilot_sport_4s-1/900x900/neumatico-michelin-pilot-sport-4s-275-30-r21-98-y-xl--2175490.png'),
(34, 'PHILIPS - 2 ✕ H7 RacingVision GT200 - 12972RGTS2', 34.8, 45, 'https://encrypted-tbn2.gstatic.com/shopping?q=tbn:ANd9GcQO3AWgvaSRfLaWig1DIvfuwKCnYLugosGmq5GHYDuZtRhYrzmpdJXQjSErZYwD764ppTMcNypv0BcaxntRm6IAn7OAFFJb8PdbLXl1cLKMH_CT8TFCUHNl'),
(35, 'Philips X-tremeVision Pro150 H7 bombilla faros del', 26.3, 16, 'https://encrypted-tbn2.gstatic.com/shopping?q=tbn:ANd9GcR9ZuyuVJj9CerhXefyfB2VWKJXYeCsiW1f3w408n7T9yJvfe8-9XYnMQCrN0MxF8v9Mh7mtAILfHbIsH5U0RYnzHJ09s9Um3ZgwUOlSSQ'),
(36, 'Philips automotive lighting Ultinon Pro6000 Boost ', 84.82, 123, 'https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcS0UhnvW1y8PnFRJVhpHJ1qkBW-LQ_n1_NZzqNy4-CMx0LhP30MH4eGhQ0sux6jpmztJ0RcgOwYG6LdRpLG6155xZjII_bAi_6nmogSdiqHL6V5jkjbBiVFWA'),
(37, 'Philips RacingVision GT200 H4 bombilla para faros ', 20.92, 158, 'https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcTdDasootrCvDTnBQOYzphHGe0XMS30tkAQ3o0-hKXSyJmfGzLmq3LNEwjuPaNe-w_uCXW3Oh1Bb0M2FiMnL6y_1L6wn5zBH2UykktLQUBvuQhpQtWxlKZw'),
(38, 'KOYOSO H11 LED Bombilla 19000LM 110W para 12V Auto', 34.65, 32, 'https://encrypted-tbn2.gstatic.com/shopping?q=tbn:ANd9GcTIJB1aKdQ_MDCwq-7nVO5NaDGvYEHP8rGffk_IJbBwSg2s7h_D57aRcTavBMeEojc247GNICjLzbTKMoIcniqqHA0FVGRoo4TmE4sF1WxK84VGKc7lbVQl'),
(39, 'KOYOSO Bombillas 9006/HB4 LED Coche, LED Faro Lámp', 42.68, 356, 'https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcR6bA2tJ990FKS6cJAF4d5I_bJPYfbcvulh52Z2puJy1Xtbg_pnSXnwm59WBC3I9HkNbtnAHWnr5qBfTPFmvGehoDUml7ONTwbrDsjHSig'),
(40, 'JOREST 300Pcs 12v Fusibles Coche Kit, 160 Mini Fus', 20.32, 789, 'https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcRjDygduuDxQwW5HmrCySknAfx-M3W3DJUiRnJUoXu8F-yJjUXUiSKGglqMRsKhtsDy9nJ0OrVVYkPgUqCVzQfOckhjKuiynfACt5SzDHZj5wxNhliEKKA9'),
(41, 'BOSCH 1 987 529 079 Surtido, fusibles', 60.72, 45, 'https://encrypted-tbn2.gstatic.com/shopping?q=tbn:ANd9GcRdLiX3N07FeqMDgkQO1UYRYIj5CixCSzDej-L7-zJLilJJlMcQaSN3E7I5dA2Gh0b0FNUg63StGNJgTKOohJc0GLd0BRXWCGq18Y-LzMjuoYEiq7D8T3mt'),
(42, '20 piezas para coche y camión, relé automotriz DC ', 21.92, 56, 'https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcSp-EIICqB1AwZ8NCrRth30lXAWdlADG-Hkg3kSrFtZiOgaWwUX3tI-tkrXOP8GZ5nGl67U9q8IOcSr7YxfGgp7kAMsSo8HpLCO-MTp4oZwq2Njx5G6xXPJ'),
(43, 'Gebildet Caja Relé y Fusible 12 V con 5pcs Relés 5', 31.29, 99, 'https://encrypted-tbn2.gstatic.com/shopping?q=tbn:ANd9GcRdLiX3N07FeqMDgkQO1UYRYIj5CixCSzDej-L7-zJLilJJlMcQaSN3E7I5dA2Gh0b0FNUg63StGNJgTKOohJc0GLd0BRXWCGq18Y-LzMjuoYEiq7D8T3mt'),
(44, 'AUKENIEN Micro Fusibles Coche Kit 2A 3A 5A 7,5A 10', 16.82, 5, 'https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcTJmcsS2F8J-5QQflyqGlDDZj6fsln-F4s6dJdqcAb2jw5ohlgTjVqn3Aa6ePdTxnshlxt--MtOnKrQGfcBb3Rn59eYGVppBN9muolWMbwaB19QY58z5sBA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reseñas`
--

CREATE TABLE `reseñas` (
  `id_reseña` int(5) NOT NULL,
  `id_producto` int(5) NOT NULL,
  `valoraciones` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesiones`
--

CREATE TABLE `sesiones` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `fecha_inicio` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_expiracion` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contraseña_hash` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `contraseña_hash`, `fecha_registro`) VALUES
(1, 'Alonso', 'alonsorayo2001@gmail.com', '$2y$10$X6glIN0IWsL6GWeJgj95BOCu7Y/TZtYjYwQIeCYpPyeHS9oSPhKQy', '2024-05-21 16:40:11'),
(2, 'Alonso', 'alkansklnd@gmail.com', '$2y$10$Ev4mLWjGf3PgwjnZ6KK8S.Nh0r/2LpE8MEuw75StZA9ZmyoOMZYxy', '2024-06-03 16:27:17');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  

--
-- Indices de la tabla `reseñas`
--
ALTER TABLE `reseñas`
  ADD PRIMARY KEY (`id_reseña`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `sesiones`
--
ALTER TABLE `sesiones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `reseñas`
--
ALTER TABLE `reseñas`
  MODIFY `id_reseña` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sesiones`
--
ALTER TABLE `sesiones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--

  
--
-- Filtros para la tabla `reseñas`
--
ALTER TABLE `reseñas`
  ADD CONSTRAINT `reseñas_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `sesiones`
--
ALTER TABLE `sesiones`
  ADD CONSTRAINT `sesiones_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
