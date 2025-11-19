<?php
require_once "Productos_model.php";

$model = new ProductoModel();
$producto = null;

if (isset($_GET['id'])) {
    $producto = $model->obtener($_GET['id']);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../Css/Form_productos.css">
    <title><?= $producto ? "Editar Producto" : "Nuevo Producto" ?></title>
</head>

<body>

<?php include "../includes/Header.php"; ?>

<div class="contenedor-pagina">
    <div class="main-productos">

        <h1><?= $producto ? "Editar Producto" : "Nuevo Producto" ?></h1>

        <form action="Guardar_producto.php" method="POST" enctype="multipart/form-data" class="formulario">

            <input type="hidden" name="idproducto" value="<?= $producto->idproducto ?? "" ?>">

            <label>Nombre:</label>
            <input type="text" name="nombre" required value="<?= $producto->nombre ?? "" ?>">

            <label>Precio:</label>
            <input type="number" step="0.01" name="precio" required value="<?= $producto->precio ?? "" ?>">

            <label>Cantidad:</label>
            <input type="number" name="cantidad" required value="<?= $producto->cantidad ?? "" ?>">

            <label>Categoría:</label>
            <select name="categoria" required>
                <option value="">Seleccionar...</option>

                <?php
                $categorias = [
                    "Pochoclos Dulces",
                    "Pochoclos Salados",
                    "Bebidas",
                    "Caramelos",
                    "Snacks"
                ];
                foreach ($categorias as $cat):
                ?>
                    <option value="<?= $cat ?>" <?= isset($producto) && $producto->categoria == $cat ? "selected" : "" ?>>
                        <?= $cat ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Descripción:</label>
            <textarea name="descripcion"><?= $producto->descripcion ?? "" ?></textarea>

            <label>Imagen:</label>
            <input type="file" name="imagen">

            <?php if (!empty($producto->imagen)): ?>
                <img src="../img/productos/<?= $producto->imagen ?>" class="img-previa">
            <?php endif; ?>

            <label>Estado:</label>
            <select name="estado">
                <option value="activo" <?= isset($producto) && $producto->estado=="activo" ? "selected" : "" ?>>Activo</option>
                <option value="inactivo" <?= isset($producto) && $producto->estado=="inactivo" ? "selected" : "" ?>>Inactivo</option>
            </select>

            <button class="btn-guardar" type="submit">Guardar</button>
            <a href="ProductosGUI.php" class="btn-cancelar">Cancelar</a>

        </form>

    </div>
</div>

</body>
</html>
