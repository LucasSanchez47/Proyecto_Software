<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto | MagicScreen</title>
    <link rel="stylesheet" href="../Css/Contacto.css">
</head>
<body>
    <?php include "../includes/Header.php"; ?>
<main class="contacto-container">

    <h2>📨 Contactanos</h2>
    <p class="subtitulo">¿Tenés alguna duda, sugerencia o consulta? ¡Escribinos!</p>

    <div class="contacto-contenido">

        <!-- Formulario -->
        <form class="formulario-contacto" action="enviar_contacto.php" method="POST">
            <label>Nombre Completo</label>
            <input type="text" name="nombre" required>

            <label>Correo Electrónico</label>
            <input type="email" name="correo" required>

            <label>Asunto</label>
            <input type="text" name="asunto" required>

            <label>Mensaje</label>
            <textarea name="mensaje" required></textarea>

            <button type="submit">Enviar Mensaje</button>
        </form>

    </div>

</main>

    <?php include '../includes/Footer.php'; ?>


</body>
</html>
