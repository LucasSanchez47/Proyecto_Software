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
    <title>CineStar - Tu cine favorito 🎬</title>
    <link rel="stylesheet" href="Css/Principal.css">
</head>
<body>
    <!-- === Encabezado === -->
    <header>
        <div class="logo">
            <img src="img/logo.png" alt="Logo CineStar">
            <h1>CineStar</h1>
        </div>

        <nav>
            <ul>
                <li><a href="index.php" class="active">Inicio</a></li>
                <li><a href="cartelera.php">Cartelera</a></li>
                <li><a href="promociones.php">Promociones</a></li>
                <li><a href="contacto.php">Contacto</a></li>
                <?php if(isset($_SESSION['nombre'])): ?>

                <?php if(isset($_SESSION['idCargo']) && $_SESSION['idCargo'] == 1): ?>
                    <li><a href="php/Administrador.php">Panel Admin</a></li>
                <?php endif; ?>
                    <li><a href="php/Perfil.php">👤 <?= htmlspecialchars($_SESSION['nombre']); ?></a></li>
                    <li><a href="php/Cerrar_Sesion.php">Salir</a></li>
                <?php else: ?>
                    <li><a href="php/Login.php">Iniciar Sesión</a></li>
                    <li><a href="php/Registro.php">Registrarse</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

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
            <h2>🎥 Estrenos de la Semana</h2>
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
            <h2>🍿 Promociones</h2>
            <p>Disfrutá del mejor cine con combos especiales de pochoclos, gaseosas y descuentos 2x1 los miércoles.</p>
            <a href="promociones.php" class="btn">Ver más</a>
        </section>
    </main>

    <!-- === Pie de página === -->
    <footer>
        <p>&copy; <?= date("Y") ?> CineStar. Todos los derechos reservados.</p>
        <p>📍 Av. Siempre Viva 742 - Ciudad</p>
    </footer>
</body>
</html>
