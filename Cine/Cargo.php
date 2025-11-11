<?php
class Cargo {
    private $idCargo;
    private $Cargo;

    // GET Y SET (Observadores y Modificadores)
    public function getidCargo() {
        return $this->idCargo;
    }

    public function setidCargo($idCargo) {
        $this->idCargo = $idCargo;
    }

    public function getCargo() {
        return $this->Cargo;
    }

    public function setCargo($Cargo) {
        $this->Cargo = $Cargo;
    }
}
?>