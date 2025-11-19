<?php
// Mostrar errores en desarrollo (quitar en producción)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/Productos_model.php"; // uso __DIR__ para evitar problemas de rutas

$model = new ProductoModel();

// Verificar que exista id en GET
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Mensaje claro para debug
    echo "ID no recibido. Prueba con: ?id=1";
    exit;
}

$id = $_GET['id'];

// Validar que el id sea numérico
if (!ctype_digit((string)$id)) {
    echo "ID inválido.";
    exit;
}

try {
    // Obtener producto para saber si existe y la imagen
    $producto = $model->obtener($id);

    if (!$producto) {
        echo "Producto no encontrado (id={$id}).";
        exit;
    }

    // Intentar eliminar del BD
    $ok = $model->eliminar($id);

    if (!$ok) {
        echo "Error al eliminar en la base de datos.";
        exit;
    }

    // Si tenía imagen, intentar borrar archivo del servidor
    if (!empty($producto->imagen)) {
        $rutaImagen = __DIR__ . "/../uploads/" . $producto->imagen;
        if (file_exists($rutaImagen) && is_writable($rutaImagen)) {
            @unlink($rutaImagen); // eliminamos y suprimimos warning si falla
        }
    }

    // Redirigir de vuelta al listado — usá la ruta absoluta/relativa correcta
    header("Location: ProductosGUI.php");
    exit;

} catch (Exception $e) {
    echo "Excepción: " . $e->getMessage();
    exit;
}
