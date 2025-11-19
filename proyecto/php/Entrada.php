<?php
class Entrada {
    private $Cod_Entrada;
    private $fecha;
    private $ID_Funcion;
    private $ID_Usuario;
    private $ID_Asiento;

    public function getCodEntrada(){ return $this->Cod_Entrada; }
    public function setCodEntrada($v){ $this->Cod_Entrada = $v; }

    public function getFecha(){ return $this->fecha; }
    public function setFecha($v){ $this->fecha = $v; }

    public function getIDFuncion(){ return $this->ID_Funcion; }
    public function setIDFuncion($v){ $this->ID_Funcion = $v; }

    public function getIdUsuario(){ return $this->ID_Usuario; }
    public function setIdUsuario($v){ $this->ID_Usuario = $v; }

    public function getIDAsiento(){ return $this->ID_Asiento; }
    public function setIDAsiento($v){ $this->ID_Asiento = $v; }
}
