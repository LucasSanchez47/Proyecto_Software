<?php
class Funcion {
    private $ID_Funcion;
    private $ID_Pelicula;
    private $ID_Sala;
    private $fecha;
    private $horario;
    private $precio;
    private $titulo;       // titulo de la película
    private $salaNombre;   // nombre de la sala

    public function setIDFuncion($v){ $this->ID_Funcion = $v; }
    public function getIDFuncion(){ return $this->ID_Funcion; }

    public function setIDPelicula($v){ $this->ID_Pelicula = $v; }
    public function getIDPelicula(){ return $this->ID_Pelicula; }

    public function setIDSala($v){ $this->ID_Sala = $v; }
    public function getIDSala(){ return $this->ID_Sala; }

    public function setFecha($v){ $this->fecha = $v; }
    public function getFecha(){ return $this->fecha; }

    public function setHorario($v){ $this->horario = $v; }
    public function getHorario(){ return $this->horario; }

    public function setPrecio($v){ $this->precio = $v; }
    public function getPrecio(){ return $this->precio; }

    public function setTitulo($v){ $this->titulo = $v; }
    public function getTitulo(){ return $this->titulo; }

    public function setSalaNombre($v){ $this->salaNombre = $v; }
    public function getSalaNombre(){ return $this->salaNombre; }
}

