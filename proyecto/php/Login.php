<?php
session_start();
require_once 'Usuario.php';
require_once 'Usuario_model.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = filter_input(INPUT_POST, 'correo', FILTER_VALIDATE_EMAIL);
    $clave = $_POST['clave'] ?? '';

    if ($correo && $clave) {
        $usuarioModel = new UsuarioModel();
        $usuario = new Usuario();
        $usuario->setcorreo($correo);
        $usuario->setclave($clave);

        $usuarioValido = $usuarioModel->Login($usuario);

        if ($usuarioValido != null) {
            $_SESSION['idUsuario'] = $usuarioValido->getidusuario();
            $_SESSION['nombre'] = $usuarioValido->getnombre();
            $_SESSION['idCargo'] = $usuarioValido->getidcargo();
            $_SESSION['fotoPerfil'] = $usuarioValido->getfotoPerfil();
            header("Location: ../index.php");
            exit();
        } else {
            $error = "Correo o clave incorrectos.";
        }
    } else {
        $error = "Por favor, ingrese un correo válido y su clave.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../Css/Login.css">
    <link rel="icon" href="../img/logof.png" type="image/x-iconn">
</head>
<body>
    
    <div class="container">
        <h1>Iniciar Sesión</h1>

        <?php if ($error): ?>
            <p style="color:red;"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form method="post" action="Login.php">
            <label>Correo:</label>
            <input type="email" name="correo" required><br>
            <label>Clave:</label>
            <input type="password" name="clave" required><br>
            <button type="submit">Ingresar</button>
        </form>

        <p>¿No tienes cuenta? <a href="Registro.php">Regístrate aquí</a></p>
    </div>

</body>
</html>
