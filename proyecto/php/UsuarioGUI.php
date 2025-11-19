<?php
require_once 'Usuario.php';
require_once 'Usuario_model.php';
require_once 'Cargo.php';
require_once 'Cargo_model.php';

session_start();

// Validación de sesión
if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit();
}

$usuariomodel = new UsuarioModel();
$cargomodel = new CargoModel();

// objeto usuario vacío por defecto (para el formulario)
$usuario = new Usuario();

// Manejo del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['operacion'])) {
    $operacion = $_POST['operacion'];

    $idUsuario = filter_input(INPUT_POST, 'idUsuario', FILTER_VALIDATE_INT);
    $nombre = trim($_POST['Nombre'] ?? '');
    $apellido = trim($_POST['Apellido'] ?? '');
    $direccion = trim($_POST['Direccion'] ?? '');
    $correo = filter_input(INPUT_POST, 'Correo', FILTER_VALIDATE_EMAIL);
    $clave = $_POST['Clave'] ?? '';
    $idCargo = filter_input(INPUT_POST, 'Cargo', FILTER_VALIDATE_INT);
    $telefono = trim($_POST['Num_telefono'] ?? '');

    switch ($operacion) {
        case 'actualizar':
            $usuario->setidusuario($idUsuario);
            $usuario->setnombre($nombre);
            $usuario->setapellido($apellido);
            $usuario->setdireccion($direccion);
            $usuario->setcorreo($correo);
            $usuario->setidcargo($idCargo);
            $usuario->settelefono($telefono);
            if (!empty($clave)) {
                $usuario->setclave(password_hash($clave, PASSWORD_DEFAULT));
            }
            // Manejo imagen
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['foto']['tmp_name'];
                $fileName = $_FILES['foto']['name'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                if (in_array($fileExtension, $allowedExtensions)) {
                    $newFileName = uniqid() . '.' . $fileExtension;
                    $dest_path = 'uploads/perfiles/' . $newFileName;
                    if (move_uploaded_file($fileTmpPath, $dest_path)) {
                        $usuario->setfotoPerfil($newFileName);
                    }
                }
            }
            $usuariomodel->Actualizar($usuario);
            header('Location: UsuarioGUI.php');
            exit();

        case 'registrar':
            $usuario->setnombre($nombre);
            $usuario->setapellido($apellido);
            $usuario->setdireccion($direccion);
            $usuario->setcorreo($correo);
            $usuario->setidcargo($idCargo);
            $usuario->setclave(password_hash($clave, PASSWORD_DEFAULT));
            $usuario->settelefono($telefono);
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['foto']['tmp_name'];
                $fileName = $_FILES['foto']['name'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                if (in_array($fileExtension, $allowedExtensions)) {
                    $newFileName = uniqid() . '.' . $fileExtension;
                    $dest_path = 'uploads/perfiles/' . $newFileName;
                    if (move_uploaded_file($fileTmpPath, $dest_path)) {
                        $usuario->setfotoPerfil($newFileName);
                    }
                }
            }
            $usuariomodel->Registrar($usuario);
            header('Location: UsuarioGUI.php');
            exit();

        case 'eliminar':
            $idEliminar = filter_input(INPUT_POST, 'idusuario', FILTER_VALIDATE_INT);
            if ($idEliminar) {
                $usuariomodel->Eliminar($idEliminar);
            }
            header('Location: UsuarioGUI.php');
            exit();

        case 'editar':
            $idEditar = filter_input(INPUT_POST, 'idusuario', FILTER_VALIDATE_INT);
            if ($idEditar) {
                $usuario = $usuariomodel->Obtener($idEditar);
                if (!$usuario) {
                    // Si no existe el usuario, aseguramos que $usuario sea objeto vacío para el formulario
                    $usuario = new Usuario();
                }
            }
            break;
    }
}

// === IMPORTANT: cargamos la lista de usuarios para el listado ===
$usuarios = $usuariomodel->Listar(); // <- asegura que $usuarios no sea null

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="../Css/Usuario.css">
</head>
<body>

    <?php include "../includes/Header.php"; ?>

<div class="contenedor-usuarios">
    <h1>Administración de Usuarios</h1>

    <!-- FORMULARIO -->
    <form action="UsuarioGUI.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="operacion" value="<?= ($usuario->getidusuario() > 0) ? 'actualizar' : 'registrar'; ?>">
    <input type="hidden" name="idUsuario" value="<?= htmlspecialchars($usuario->getidusuario()); ?>">

    <label>Nombre:</label>
    <input type="text" name="Nombre" required value="<?= htmlspecialchars($usuario->getnombre() ?? ''); ?>">

    <label>Apellido:</label>
    <input type="text" name="Apellido" required value="<?= htmlspecialchars($usuario->getapellido() ?? ''); ?>">

    <label>Dirección:</label>
    <input type="text" name="Direccion" value="<?= htmlspecialchars($usuario->getdireccion() ?? ''); ?>">

    <label>Teléfono:</label>
    <input type="text" name="Num_telefono" required 
        value="<?= htmlspecialchars($usuario->gettelefono() ?? ''); ?>">

    <label>Correo:</label>
    <input type="email" name="Correo" required value="<?= htmlspecialchars($usuario->getcorreo() ?? ''); ?>">

    <label>Clave:</label>
    <input type="password" name="Clave" <?= ($usuario->getidusuario() < 1) ? 'required' : ''; ?>>

    <label>Cargo:</label>
    <select name="Cargo" required>
        <option value="">Seleccione...</option>
        <?php
        $cargos = ($_SESSION['idCargo'] < 3) ? $cargomodel->ListarTodos() : $cargomodel->ListarRestringidos();
        foreach ($cargos as $r):
            $selected = ($usuario->getidcargo() == $r->getidCargo()) ? 'selected' : '';
            echo "<option value='" . htmlspecialchars($r->getidCargo()) . "' $selected>" . htmlspecialchars($r->getCargo()) . "</option>";
        endforeach;
        ?>
    </select>

    <label>Foto de perfil:</label>
    <input type="file" name="foto" accept=".jpg,.jpeg,.png,.gif">

    <button type="submit"><?= ($usuario->getidusuario() > 0) ? 'Actualizar' : 'Registrar'; ?></button>
</form>

    <!-- TABLA -->
    <h2>Listado de Usuarios</h2>

    <?php if (!empty($usuarios) && is_array($usuarios) || is_object($usuarios)): ?>
    <table>
        <tr>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Dirección</th>
            <th>Correo</th>
            <th>Cargo</th>
            <th>Acciones</th>
        </tr>

        <?php foreach ($usuarios as $r): ?>
            <tr>
                <td>
                    <?php if ($r->getfotoPerfil()): ?>
                        <img src="uploads/perfiles/<?= htmlspecialchars($r->getfotoPerfil()); ?>" alt="Foto" width="60">
                    <?php else: ?>
                        <span class="sin-foto">Sin foto</span>
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($r->getnombre()); ?></td>
                <td><?= htmlspecialchars($r->getapellido()); ?></td>
                <td><?= htmlspecialchars($r->getdireccion()); ?></td>
                <td><?= htmlspecialchars($r->getcorreo()); ?></td>
                <td><?= htmlspecialchars($r->getcargo()); ?></td>
                <td>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="operacion" value="editar">
                        <input type="hidden" name="idusuario" value="<?= htmlspecialchars($r->getidusuario()); ?>">
                        <button type="submit" class="btn-editar">Editar</button>
                    </form>

                    <form method="post" style="display:inline;" onsubmit="return confirm('¿Desea eliminar este usuario?');">
                        <input type="hidden" name="operacion" value="eliminar">
                        <input type="hidden" name="idusuario" value="<?= htmlspecialchars($r->getidusuario()); ?>">
                        <button type="submit" class="btn-eliminar">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php else: ?>
        <p class="no-registros">No hay usuarios registrados.</p>
    <?php endif; ?>
</div>
</body>
</html>
