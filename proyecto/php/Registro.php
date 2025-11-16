<?php
require_once 'Usuario.php';
require_once 'Usuario_model.php';

$error = '';
$exito = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $apellido = trim($_POST['apellido'] ?? '');
    $direccion = trim($_POST['direccion'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $correo = filter_input(INPUT_POST, 'correo', FILTER_VALIDATE_EMAIL);
    $clave = $_POST['clave'] ?? '';

    // Validación
    if ($nombre && $apellido && $direccion && $telefono && $correo && $clave) {

        $usuarioModel = new UsuarioModel();
        $usuario = new Usuario();

        $usuario->setnombre($nombre);
        $usuario->setapellido($apellido);
        $usuario->setdireccion($direccion);
        $usuario->settelefono($telefono);
        $usuario->setcorreo($correo);
        $usuario->setclave(password_hash($clave, PASSWORD_DEFAULT));

        // Cargo 2 = Cliente
        $usuario->setidcargo(2); 

        $usuarioModel->Registrar($usuario);

        $exito = "Registro exitoso. Ahora puedes <a href='Login.php'>iniciar sesión</a>.";

    } else {
        $error = "Todos los campos son obligatorios y deben ser válidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="../Css/Registro.css">
</head>
<body>

<div class="registro-container">
    <div class="registro-box">

        <h1>Registro de Usuario</h1>

        <?php if ($error): ?>
            <p style="color:red;"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <?php if ($exito): ?>
            <p style="color:green;"><?= $exito; ?></p>
        <?php else: ?>

            <form method="post" action="Registro.php">
                <input type="text" name="nombre" placeholder="Nombre" required>
                <input type="text" name="apellido" placeholder="Apellido" required>
                <input type="text" name="direccion" placeholder="Dirección" required>
                <input type="text" name="telefono" placeholder="Número de teléfono" required> <!-- NUEVO -->
                <input type="email" name="correo" placeholder="Correo electrónico" required>
                <input type="password" name="clave" placeholder="Contraseña" required>

                <button type="submit">Registrarse</button>
            </form>

        <?php endif; ?>

        <p>¿Ya tienes cuenta? <a href="Login.php">Inicia sesión aquí</a></p>
    </div>
</div>

</body>
</html>
