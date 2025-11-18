<?php
require_once "Peliculas_model.php";
require_once "Estado_model.php";

$model = new PeliculaModel();
$modelEstado = new EstadoModel();

$lista = $model->listar();
$estados = $modelEstado->listar();

// convertir estados a array [id => nombre]
$mapEstados = [];
foreach ($estados as $e) {
    $mapEstados[$e->getidestado()] = $e->getnombre();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Películas</title>
    <link rel="stylesheet" href="../Css/Peliculas.css">
    <link rel="icon" href="../img/logof.png" type="image/x-icon">
</head>
<body>

<?php include "../includes/Header.php"; ?>

<div class="main-peliculas">

    <h1>Administración de Películas</h1>

    <a href="Form_peliculas.php" class="btn-agregar">+ Nueva Película</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Género</th>
            <th>Duración</th>
            <th>Estado</th>
            <th>Poster</th>
            <th>Acciones</th>
        </tr>

        <?php if (count($lista) > 0): ?>
            <?php foreach ($lista as $p): ?>
                <tr>
                    <td><?= $p->getidpelicula() ?></td>

                    <td><?= htmlspecialchars($p->gettitulo()) ?></td>

                    <td><?= htmlspecialchars($p->getgenero()) ?></td>

                    <td><?= htmlspecialchars($p->getduracion()) ?> min</td>

                    <td>
                        <?= isset($mapEstados[$p->getidestado()])
                            ? htmlspecialchars($mapEstados[$p->getidestado()])
                            : "Sin estado" ?>
                    </td>

                    <td>
                        <?php if ($p->getposter()): ?>
                            <img class="poster-mini" src="../img/<?= htmlspecialchars($p->getposter()) ?>">
                        <?php else: ?>
                            <span class="no-img">Sin imagen</span>
                        <?php endif; ?>
                    </td>

                    <td>
                        <a class="btn-editar" href="Form_peliculas.php?id=<?= $p->getidpelicula() ?>">Editar</a>

                        <a class="btn-eliminar"
                           href="Eliminar_peliculas.php?id=<?= $p->getidpelicula() ?>"
                           onclick="return confirm('¿Eliminar película?')">
                           Eliminar
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>

        <?php else: ?>
            <tr>
                <td colspan="7" class="no-registros">No hay películas registradas.</td>
            </tr>
        <?php endif; ?>

    </table>

</div>

</body>
</html>
