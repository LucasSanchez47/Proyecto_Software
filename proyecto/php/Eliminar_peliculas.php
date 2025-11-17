<?php
require_once "Peliculas_model.php";

$id = $_GET["id"];

$model = new PeliculaModel();
$model->eliminar($id);

header("Location: PeliculasGUI.php");
?>
