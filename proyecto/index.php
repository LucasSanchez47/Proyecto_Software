<?php
session_start();
require_once 'php/Conexion.php';
require_once 'php/Usuario.php';
require_once 'php/Usuario_model.php';
require_once 'php/Peliculas_model.php';

$modelPeliculas = new PeliculaModel();
$estrenos = $modelPeliculas->obtenerEstrenos(3); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>MagicScreen - Tu cine favorito</title>
    <link rel="stylesheet" href="Css/Principal.css">
    <link rel="icon" href="img/logof.png" type="image/x-iconn">
</head>
<body>
    <!-- === Encabezado === -->
    <?php include "includes/Header.php"; ?>

    <!-- === Contenido Principal === -->
    <main>
        <section class="banner">
            <div class="overlay">
                <h2>¡Vive la magia del cine!</h2>
                <p>Descubre los últimos estrenos y promociones especiales.</p>
                <a href="cartelera.php" class="btn">Ver Cartelera</a>
            </div>
        </section>

        <section class="peliculas">
            <h2> Estrenos de la Semana</h2>
            <div class="grid-peliculas">
                <?php foreach ($estrenos as $p): ?>
                    <div class="pelicula">
                        <img src="img/<?= htmlspecialchars($p->getposter()) ?>" alt="Poster">
                        <h3><?= htmlspecialchars($p->gettitulo()) ?></h3>
                        <p><?= htmlspecialchars($p->getgenero()) ?> | <?= htmlspecialchars($p->getduracion()) ?> min</p>
                    </div>
                <?php endforeach; ?>

                <?php if (count($estrenos) == 0): ?>
                    <p class="no-peliculas">No hay estrenos cargados.</p>
                <?php endif; ?>
            </div>

        </section>

        <section class="promocion">
            <h2>Promociones</h2>
            <p>Disfrutá del mejor cine con combos especiales de pochoclos, gaseosas y descuentos 2x1 los miércoles.</p>
            <a href="promociones.php" class="btn">Ver más</a>
        </section>
    </main>

    <!-- === Pie de página === -->
    <?php include 'includes/Footer.php'; ?>

</body>
</html>
