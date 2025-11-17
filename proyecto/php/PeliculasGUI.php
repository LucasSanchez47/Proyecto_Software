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
    <link rel="stylesheet" href="Css/Principal.css">
</head>
<body>

<h1>Administrar Películas</h1>

<a href="Form_peliculas.php" class="btn">+ Nueva Película</a>

<table class="tabla">
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
            <td><?= $p->gettitulo() ?></td>
            <td><?= $p->getgenero() ?></td>
            <td><?= $p->getduracion() ?> min</td>
            <td><img src="../img/<?= $p->getposter() ?>" width="60"></td>
            <td>
                <a href="Form_peliculas.php?id=<?= $p->getidpelicula() ?>">Editar</a>
                <a href="Eliminar_peliculas.php?id=<?= $p->getidpelicula() ?>"
                   onclick="return confirm('¿Eliminar película?')">
                   Eliminar
                </a>
            </td>
        </tr>
    <?php } ?>
</table>

</body>
</html>
