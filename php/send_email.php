<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $to = "alonsogonzalezdeaguilar3@gmail.com"; // Cambia esto a tu correo electrónico
    $from = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Validar el correo electrónico
    if (!filter_var($from, FILTER_VALIDATE_EMAIL)) {
        echo "Correo electrónico inválido.";
        exit;
    }

    // Encabezados del correo
    $headers = "From: " . $from;

    // Asunto del correo
    $subject = "Nuevo mensaje de contacto";

    // Mensaje del correo
    $body = "Has recibido un nuevo mensaje de " . $from . ":\n\n" . $message;

    // Enviar correo y verificar errores
    if (mail($to, $subject, $body, $headers)) {
        echo "Mensaje enviado exitosamente.";
    } else {
        // Imprimir mensaje de error detallado
        echo "Error al enviar el mensaje. Detalles: " . error_get_last()['message'];
    }
} else {
    echo "Método de solicitud no válido.";
}
?>
