<?php
require_once "Productos_model.php";

$model = new ProductoModel();

$id = $_POST["idproducto"] ?? null;

// Imagen
$nombreImagen = null;

if (!empty($_FILES["imagen"]["name"])) {
    $nombreImagen = time() . "_" . basename($_FILES["imagen"]["name"]);
    $ruta = "../img/productos/" . $nombreImagen;
    move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);
}

// Si actualiza y NO subió imagen → conservar la existente
if ($id) {
    $productoExistente = $model->obtener($id);
    if ($productoExistente && !$nombreImagen) {
        $nombreImagen = $productoExistente->imagen;
    }
}

$data = [
    "idproducto" => $id,
    "nombre" => $_POST["nombre"],
    "cantidad" => $_POST["cantidad"],
    "categoria" => $_POST["categoria"],
    "precio" => $_POST["precio"],
    "descripcion" => $_POST["descripcion"],
    "imagen" => $nombreImagen,
    "estado" => $_POST["estado"]
];

$model->guardar($data);

header("Location: ProductosGUI.php");
exit;
