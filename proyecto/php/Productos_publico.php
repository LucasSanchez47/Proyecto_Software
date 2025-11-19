<?php
require_once "Productos_model.php";

$model = new ProductoModel();
$productos = $model->listar(); // Trae TODOS los productos
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos Disponibles</title>
    <link rel="stylesheet" href="../Css/Productos_publico.css">
</head>
<body>

<?php include "../includes/Header.php"; ?>

<div class="productos-container">

    <h1>Productos Disponibles</h1>

    <?php
    // Categorías fijas (iguales a formulario de alta/edicion)
    $categorias = [
        "Pochoclos Dulces",
        "Pochoclos Salados",
        "Bebidas",
        "Caramelos",
        "Snacks"
    ];

    foreach ($categorias as $cat):

        // Filtrar productos por categoría y estado ACTIVO
        $filtrados = array_filter($productos, function($p) use ($cat) {
            return strtolower($p->categoria) == strtolower($cat)
                    && strtolower($p->estado) == "activo";
        });

        if (!empty($filtrados)):
    ?>

        <h2 class="categoria-titulo"><?= $cat ?></h2>

        <div class="grid-productos">

            <?php foreach ($filtrados as $prod): ?>

                <div class="card-producto">

                    <img src="../img/productos/<?= $prod->imagen ?>" alt="Producto">

                    <h3><?= htmlspecialchars($prod->nombre) ?></h3>

                    <p class="precio">$<?= number_format($prod->precio, 2) ?></p>

                    <?php if (!empty($prod->descripcion)): ?>
                        <p class="descripcion"><?= htmlspecialchars($prod->descripcion) ?></p>
                    <?php else: ?>
                        <p class="descripcion vacia">Sin descripción</p>
                    <?php endif; ?>

                </div>

            <?php endforeach; ?>

        </div>

    <?php endif; endforeach; ?>

</div>

</body>
</html>
