<?php
session_start();

header('Content-Type: application/json');
echo json_encode(isset($_SESSION['carrito']) ? array_values($_SESSION['carrito']) : []);
?>
