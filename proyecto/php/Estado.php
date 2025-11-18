<?php
class Estado {
    private $id_estado;
    private $nombre;

    public function getidestado() {return $this->id_estado;}
    public function setidestado($id) {$this->id_estado = $id;}

    public function getnombre() {return $this->nombre;}
    public function setnombre($nombre) {$this->nombre = $nombre;}
}
