<?php
require_once "Peliculas_model.php";

$idproducto = $_GET["idproducto"];

$model = new PeliculaModel();
$model->eliminar($idproducto);

header("Location: PeliculasGUI.php");
?>
