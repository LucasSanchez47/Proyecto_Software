<?php
require_once "Productos_model.php";
$model = new ProductoModel();
$productos = $model->listar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos | Cine</title>
    <link rel="stylesheet" href="../Css/Productos.css">
</head>

<body>

<?php include "../includes/Header.php"; ?>

<main>
    <div class="main-productos">

        <h1>Productos</h1>

        <a href="Form_productos.php" class="btn-agregar">➕ Nuevo Producto</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Categoría</th>
                    <th>Cantidad</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php if (empty($productos)): ?>
                    <tr>
                        <td colspan="8" class="no-registros">No hay productos registrados.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($productos as $p): ?>
                    <tr>
                        <td><?= $p->idproducto ?></td>

                        <!-- Imagen del producto -->
                        <td>
                            <?php if (!empty($p->imagen)): ?>
                                <img class="img-producto" src="../img/productos/<?= $p->imagen ?>" alt="Producto">
                            <?php else: ?>
                                <span class="no-img">Sin imagen</span>
                            <?php endif; ?>
                        </td>

                        <td><?= $p->nombre ?></td>
                        <td>$<?= number_format($p->precio, 2) ?></td>
                        <td><?= $p->categoria ?></td>
                        <td><?= $p->cantidad ?></td>

                        <!-- Estado -->
                        <td>
                            <?php if ($p->estado == "activo"): ?>
                                <span class="estado-activo">Activo</span>
                            <?php else: ?>
                                <span class="estado-inactivo">Inactivo</span>
                            <?php endif; ?>
                        </td>

                        <!-- Acciones -->
                        <td>
                            <a class="btn-editar" href="Form_productos.php?id=<?= $p->idproducto ?>">Editar</a>
                            <a class="btn-eliminar" 
                                onclick="return confirm('¿Eliminar producto?')"  
                                href="Eliminar_producto.php?id=<?= $p->idproducto ?>">
                                Eliminar
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>

        </table>

    </div>
</main>

</body>
</html>
