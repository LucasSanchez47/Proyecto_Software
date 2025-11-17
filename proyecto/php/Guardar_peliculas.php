<?php
require_once "Peliculas_model.php";

$model = new PeliculaModel();
$p = new Pelicula();

// leer datos
$p->setidpelicula($_POST["id"]);
$p->settitulo($_POST["titulo"]);
$p->setdescripcion($_POST["descripcion"]);
$p->setduracion($_POST["duracion"]);
$p->setgenero($_POST["genero"]);
$p->setestreno($_POST["estreno"]);

// manejar imagen
$archivo = $_FILES["poster"]["name"];

if ($archivo != "") {

    // guardar en carpeta raíz del proyecto
    $ruta = "../img/" . basename($archivo);

    if (move_uploaded_file($_FILES["poster"]["tmp_name"], $ruta)) {
        $p->setposter($archivo);
    } else {
        die("❌ Error moviendo archivo.");
    }

} else {
    // mantener imagen anterior
    if ($p->getidpelicula()) {
        $lista = $model->listar();
        foreach ($lista as $x) {
            if ($x->getidpelicula() == $p->getidpelicula()) {
                $p->setposter($x->getposter());
            }
        }
    }
}

// guardar
if ($p->getidpelicula()) {
    $model->actualizar($p);
} else {
    $model->registrar($p);
}

header("Location: PeliculasGUI.php");
