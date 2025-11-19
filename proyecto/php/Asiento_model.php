<?php
require_once 'Conexion.php';
require_once 'Asiento.php';

class AsientoModel {
    private $pdo;
    public function __construct(){
        $c = new Conexion();
        $this->pdo = $c->getConexion();
    }

    // Listar asientos por sala ordenados por fila y numero
    public function ListarPorSala(int $ID_Sala): array {
        $res = [];
        $sql = "SELECT * FROM asientos WHERE ID_Sala = ? ORDER BY fila, numero";
        $stm = $this->pdo->prepare($sql);
        $stm->execute([$ID_Sala]);
        foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
            $a = new Asiento();
            $a->setIDAsiento($r->ID_Asiento);
            $a->setIDSala($r->ID_Sala);
            $a->setFila($r->fila);
            $a->setNumero($r->numero);
            $a->setEtiqueta($r->etiqueta);
            $res[] = $a;
        }
        return $res;
    }

    public function Obtener(int $ID_Asiento): ?Asiento {
        $sql = "SELECT * FROM asientos WHERE ID_Asiento = ?";
        $stm = $this->pdo->prepare($sql);
        $stm->execute([$ID_Asiento]);
        $r = $stm->fetch(PDO::FETCH_OBJ);
        if (!$r) return null;
        $a = new Asiento();
        $a->setIDAsiento($r->ID_Asiento);
        $a->setIDSala($r->ID_Sala);
        $a->setFila($r->fila);
        $a->setNumero($r->numero);
        $a->setEtiqueta($r->etiqueta);
        return $a;
    }
}
