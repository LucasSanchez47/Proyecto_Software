<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Detectar si estamos dentro de /php/ o en raíz
$rutaBase = (strpos($_SERVER['PHP_SELF'], '/php/') !== false) ? '../' : '';
?>
<style>
<?php include __DIR__ . '/../Css/Header.css'; ?>
</style>
<header>
    <div class="logo">
        <img src="<?= $rutaBase ?>img/MagicS.png" alt="Logo CineStar" />
        <h1>MagicScreen</h1>
    </div>

    <nav>
        <ul>
            <li><a href="<?= $rutaBase ?>index.php">Inicio</a></li>
            <li><a href="<?= $rutaBase ?>cartelera.php">Cartelera</a></li>
            <li><a href="<?= $rutaBase ?>promociones.php">Promociones</a></li>
            <li><a href="<?= $rutaBase ?>php/contacto.php">Contacto</a></li>

            <?php if(isset($_SESSION['nombre'])): ?>

                <?php if($_SESSION['idCargo'] == 1): ?>
                    <li><a href="<?= $rutaBase ?>php/Administrador.php">Panel Admin</a></li>
                <?php endif; ?>

                <li><a href="<?= $rutaBase ?>php/Perfil.php"><?= htmlspecialchars($_SESSION['nombre']); ?></a></li>
                <li><a href="<?= $rutaBase ?>php/Cerrar_Sesion.php">Salir</a></li>

            <?php else: ?>
                <li><a href="<?= $rutaBase ?>php/Login.php">Iniciar Sesión</a></li>
                <li><a href="<?= $rutaBase ?>php/Registro.php">Registrarse</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
