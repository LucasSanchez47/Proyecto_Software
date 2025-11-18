<?php
require_once "Peliculas_model.php";
require_once "Estado_model.php"; // << AGREGADO

$model = new PeliculaModel();
$modelEstado = new EstadoModel(); // << AGREGADO

$pelicula = new Pelicula();
$editando = false;

// Lista de estados disponibles desde la DB
$estados = $modelEstado->listar(); // << AGREGADO

if (isset($_GET["id"])) {
    $editando = true;
    $lista = $model->listar();
    foreach ($lista as $p) {
        if ($p->getidpelicula() == $_GET["id"])
            $pelicula = $p;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $editando ? "Editar" : "Nueva" ?> Película</title>
    <link rel="stylesheet" href="../Css/Form_peliculas.css">
    <link rel="icon" href="../img/logof.png" type="image/x-iconn">
</head>

<body>

<div class="form-container">

<h1><?= $editando ? "Editar" : "Nueva" ?> Película</h1>

<form action="Guardar_peliculas.php" method="POST" enctype="multipart/form-data">

    <input type="hidden" name="id" value="<?= $pelicula->getidpelicula() ?>">

    <label>Título</label>
    <input type="text" name="titulo" value="<?= $pelicula->gettitulo() ?>" required>

    <label>Descripción</label>
    <textarea name="descripcion" required><?= $pelicula->getdescripcion() ?></textarea>

    <label>Duración (minutos)</label>
    <input type="number" name="duracion" value="<?= $pelicula->getduracion() ?>" required>

    <label>Género</label>
    <input type="text" name="genero" value="<?= $pelicula->getgenero() ?>" required>

    <label>Fecha estreno</label>
    <input type="date" name="estreno" value="<?= $pelicula->getestreno() ?>" required>


    <!-- SELECT ESTADO -->
    <label>Estado</label>
    <select name="id_estado" required>
        <option value="">Seleccionar estado...</option>
        <?php foreach ($estados as $estado) { ?>
            <option value="<?= $estado->getidestado() ?>"
                <?= $editando && $estado->getidestado() == $pelicula->getidestado() ? "selected" : "" ?>>
                <?= $estado->getnombre() ?>
            </option>
        <?php } ?>
    </select>


    <!-- POSTER -->
    <label>Poster</label>
    <input type="file" name="poster" accept="image/*">

    <?php if ($editando && $pelicula->getposter()) { ?>
        <img src="img/<?= $pelicula->getposter() ?>" width="150">
    <?php } ?>

    <button type="submit">Guardar</button>

</form>

</div>

</body>
</html>
