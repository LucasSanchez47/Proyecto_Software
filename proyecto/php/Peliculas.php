<?php
class Pelicula {
    private $idPelicula;
    private $titulo;
    private $descripcion;
    private $duracion;
    private $genero;
    private $poster;  // ruta imagen
    private $estreno; // fecha YYYY-mm-dd

    // --- Getters y setters ---
    public function getidpelicula() { return $this->idPelicula; }
    public function setidpelicula($id) { $this->idPelicula = $id; }

    public function gettitulo() { return $this->titulo; }
    public function settitulo($v) { $this->titulo = $v; }

    public function getdescripcion() { return $this->descripcion; }
    public function setdescripcion($v) { $this->descripcion = $v; }

    public function getduracion() { return $this->duracion; }
    public function setduracion($v) { $this->duracion = $v; }

    public function getgenero() { return $this->genero; }
    public function setgenero($v) { $this->genero = $v; }

    public function getposter() { return $this->poster; }
    public function setposter($v) { $this->poster = $v; }

    public function getestreno() { return $this->estreno; }
    public function setestreno($v) { $this->estreno = $v; }
}
?>
