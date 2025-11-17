

<?php
session_start();
require_once 'Usuario.php';
require_once 'Usuario_model.php';

$usuarioModel = new UsuarioModel();
$usuario = $usuarioModel->Obtener($_SESSION['idUsuario']);
$mensaje = '';


if (!isset($_SESSION['idUsuario'])) {
    header('Location: Login.php');
    exit();
}

// Guardar las fotos
define('UPLOAD_DIR', 'uploads/perfiles/');

// Crear carpeta si no existe
if (!is_dir(UPLOAD_DIR)) {
    mkdir(UPLOAD_DIR, 0755, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $direccion = trim($_POST['direccion']);
    $correo = filter_input(INPUT_POST, 'correo', FILTER_VALIDATE_EMAIL);
    $clave = $_POST['clave'] ?? '';

    if ($nombre && $apellido && $direccion && $correo) {
        $usuario->setnombre($nombre);
        $usuario->setapellido($apellido);
        $usuario->setdireccion($direccion);
        $usuario->setcorreo($correo);

        if (!empty($clave)) {
            $usuario->setclave(password_hash($clave, PASSWORD_DEFAULT));
        }

        // Manejar la imagen subida
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['foto']['tmp_name'];
            $fileName = $_FILES['foto']['name'];
            $fileSize = $_FILES['foto']['size'];
            $fileType = $_FILES['foto']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($fileExtension, $allowedExtensions)) {
                // Nombre único
                $newFileName = $_SESSION['idUsuario'] . '_' . time() . '.' . $fileExtension;
                $dest_path = UPLOAD_DIR . $newFileName;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    // Guardar el nombre de archivo en la base de datos
                    $usuario->setfotoPerfil($newFileName);
                } else {
                    $mensaje = "Error al mover la foto subida.";
                }
            } else {
                $mensaje = "Formato de foto no permitido. Solo jpg, jpeg, png, gif.";
            }
        }

        $usuarioModel->Actualizar($usuario);
        $_SESSION['nombre'] = $usuario->getnombre();
        $mensaje = $mensaje ? $mensaje : 'Datos actualizados correctamente.';
    } else {
        $mensaje = 'Todos los campos excepto la contraseña y foto son obligatorios.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Perfil</title>
    <link rel="stylesheet" href="../Css/Perfil.css">
</head>
<body>
    <div class="perfil-container">

        <h1>Mi Perfil</h1>

        <?php if ($mensaje): ?>
            <p class="mensaje <?= strpos($mensaje, 'Error') !== false ? 'error' : 'success'; ?>">
                <?= htmlspecialchars($mensaje); ?>
            </p>
        <?php endif; ?>

        <div class="foto-area">
            <?php if ($usuario->getfotoPerfil()): ?>
                <img class="foto-perfil" src="<?= UPLOAD_DIR . htmlspecialchars($usuario->getfotoPerfil()); ?>">
            <?php else: ?>
                <div class="foto-placeholder"></div>
            <?php endif; ?>
        </div>

        <form method="post" enctype="multipart/form-data">

            <div class="fila">
                <div class="campo">
                    <label>Nombre</label>
                    <input type="text" name="nombre" value="<?= htmlspecialchars($usuario->getnombre()); ?>">
                </div>

                <div class="campo">
                    <label>Apellido</label>
                    <input type="text" name="apellido" value="<?= htmlspecialchars($usuario->getapellido()); ?>">
                </div>
            </div>

            <div class="fila">
                <div class="campo">
                    <label>Dirección</label>
                    <input type="text" name="direccion" value="<?= htmlspecialchars($usuario->getdireccion()); ?>">
                </div>

                <div class="campo">
                    <label>Correo</label>
                    <input type="email" name="correo" value="<?= htmlspecialchars($usuario->getcorreo()); ?>">
                </div>
            </div>

            <div class="campo">
                <label>Contraseña (opcional)</label>
                <input type="password" name="clave">
            </div>

            <div class="campo">
                <label>Foto de perfil</label>
                <input type="file" name="foto" accept=".jpg,.jpeg,.png,.gif">
            </div>

            <button class="btn-guardar" type="submit">Actualizar</button>
        </form>

        <div class="links">
            <a href="../index.php">← Volver</a> |
            <a href="Cerrar_Sesion.php">Cerrar sesión</a>
        </div>

    </div>
</body>

</html>


