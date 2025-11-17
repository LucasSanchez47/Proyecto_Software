<?php
require_once "Peliculas_model.php";

$model = new PeliculaModel();
$lista = $model->listar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Películas</title>
    <link rel="stylesheet" href="..\CSS\Peliculas.css">
</head>
<body>

<div class="contenedor-peliculas">

    <h1>Administración de Películas</h1>

    <button class="btn-agregar"><a href="Form_peliculas.php">+ Nueva Película</a></button>

    <table>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Género</th>
            <th>Duración</th>
            <th>Poster</th>
            <th>Acciones</th>
        </tr>

        <?php foreach($lista as $p){ ?>
            <tr>
                <td><?= $p->getidpelicula() ?></td>
                <td><?= htmlspecialchars($p->gettitulo()) ?></td>
                <td><?= htmlspecialchars($p->getgenero()) ?></td>
                <td><?= $p->getduracion() ?> min</td>
                <td><img class="poster-mini" src="../img/<?= $p->getposter() ?>"></td>
                <td>
                    <a class="btn-editar" href="Form_peliculas.php?id=<?= $p->getidpelicula() ?>">Editar</a>
                    <a class="btn-eliminar" href="Eliminar_peliculas.php?id=<?= $p->getidpelicula() ?>"
                       onclick="return confirm('¿Eliminar película?')">Eliminar</a>
                </td>
            </tr>
        <?php } ?>
    </table>

</div>

</body>
</html>
