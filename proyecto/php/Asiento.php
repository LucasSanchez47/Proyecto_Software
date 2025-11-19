<?php
class Asiento {
    private $ID_Asiento;
    private $ID_Sala;
    private $fila;
    private $numero;
    private $etiqueta;

    public function getIDAsiento(){ return $this->ID_Asiento; }
    public function setIDAsiento($v){ $this->ID_Asiento = $v; }

    public function getIDSala(){ return $this->ID_Sala; }
    public function setIDSala($v){ $this->ID_Sala = $v; }

    public function getFila(){ return $this->fila; }
    public function setFila($v){ $this->fila = $v; }

    public function getNumero(){ return $this->numero; }
    public function setNumero($v){ $this->numero = $v; }

    public function getEtiqueta(){ return $this->etiqueta; }
    public function setEtiqueta($v){ $this->etiqueta = $v; }
}
