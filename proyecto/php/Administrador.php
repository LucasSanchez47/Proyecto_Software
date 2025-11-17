<?php
session_start();

if (!isset($_SESSION['idUsuario']) || $_SESSION['idCargo'] != 1) {
    header('Location: Login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel del Administrador</title>
    <link rel="stylesheet" href="../Css/Administrador.css">
</head>
<body class="admin-body">
    <div class="admin-container">

        <aside class="admin-sidebar">
            <div class="admin-user">
                <img src="Imagenes/avatar.jpg" class="avatar">
                <p>Bienvenido:</p>
                <span><?= htmlspecialchars($_SESSION['nombre']); ?></span>
            </div>

            <nav class="admin-nav">
                <ul>
                    <li><a href="UsuarioGUI.php">Administración de Usuarios</a></li>
                    <li><a href="CargoGUI.php">Administración de Cargos</a></li>
                    <li><a href="ProductoGUI.php">Administración de Productos</a></li>
                    <li><a href="PeliculasGUI.php">Administración de Películas</a></li>
                    <li><a href="Cerrar_Sesion.php" class="logout">Cerrar sesión</a></li>
                </ul>
            </nav>
        </aside>

        <main class="admin-main">
            <h1>Panel de Administración</h1>
            <p>Este es el panel de control para administradores.</p>
        </main>

    </div>
</body>
</html>

