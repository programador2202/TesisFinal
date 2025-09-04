<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $msg = strtolower(trim($_POST["msg"] ?? ""));

    // Respuestas personalizadas con enlaces HTML
    $respuestas = [
        'hola' => '¡Hola! Soy tu asistente virtual. ¿Sobre qué restaurante deseas información?',
        'horario' => 'Atendemos de lunes a domingo de 11:00 am a 7:00 pm.',
        'precio' => 'Nuestros precios varían según el plato. ¿Sobre qué restaurante o plato deseas saber el precio?',
        'gracias' => '¡Con gusto! 😊',
        'categorias' => 'Claro, te muestro las categorías: Mariscos, Pollerías, Pizzerías, Parrillas, Vitivinícolas, Cafeterías y Pastelerías.',
        'pizza' => 'Te muestro las <a href="views/categorias/pizzeria.php" target="_blank">pizzerías disponibles en Chincha</a>.',
        'mariscos' => 'Tenemos restaurantes de mariscos como <a href="views/restaurantes/ElGranCombo.php" target="_blank">El Gran Combo</a> y <a href="views/restaurantes/ElPuntoMarino.php" target="_blank">El Punto Marino</a>.',
        'el gran combo' => 'Puedes conocer más de El Gran Combo <a href="views/restaurantes/ElGranCombo.php" target="_blank">aquí</a>.',
        'el punto marino' => 'Puedes conocer más de El Punto Marino <a href="views/restaurantes/ElPuntoMarino.php" target="_blank">aquí</a>.',
        'dirección' => 'Estamos en Av. Principal 123, Chincha Alta. <a href="https://maps.google.com/?q=Av.+Principal+123,+Chincha+Alta" target="_blank">Ver en mapa</a>',
        'direccion' => 'Estamos en Av. Principal 123, Chincha Alta. <a href="https://maps.google.com/?q=Av.+Principal+123,+Chincha+Alta" target="_blank">Ver en mapa</a>',
        'contacto' => 'Puedes contactarnos al (056) 123-456 o por Instagram <a href="https://instagram.com/elpuntomarino" target="_blank">@elpuntomarino</a>.',
        'menu' => 'Puedes ver nuestro menú en la <a href="views/restaurantes/ElGranCombo.php#platosDestacados" target="_blank">sección de platos destacados</a>.',
        'menú' => 'Puedes ver nuestro menú en la <a href="views/restaurantes/ElGranCombo.php#platosDestacados" target="_blank">sección de platos destacados</a>.',
        'restaurantes' => 'Opciones recomendadas:<br>
            <a href="views/restaurantes/ElGranCombo.php" target="_blank">El Gran Combo</a><br>
            <a href="views/restaurantes/ElPuntoMarino.php" target="_blank">El Punto Marino</a><br>
            <a href="views/restaurantes/MisterWok.php" target="_blank">Mister Wok</a>',
        'adios' => '¡Hasta luego! Si tienes más preguntas, aquí estaré.',
    ];

    $respuesta = "Lo siento, no entendí tu consulta. ¿Puedes reformularla?";

    foreach ($respuestas as $clave => $valor) {
        if (strpos($msg, $clave) !== false) {
            $respuesta = $valor;
            break;
        }
    }

    echo $respuesta;
}
?>