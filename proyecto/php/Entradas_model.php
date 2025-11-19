<?php
require_once 'Conexion.php';
require_once 'Entrada.php';

class EntradasModel {
    private $pdo;
    public function __construct(){
        $c = new Conexion();
        $this->pdo = $c->getConexion();
    }

    // Registrar entrada (verifica que el asiento no esté ocupado para la función)
    public function Registrar(Entrada $e){
        try {
            // transacción para mayor seguridad
            $this->pdo->beginTransaction();

            // 1) comprobar asiento libre para la función
            $sqlCheck = "SELECT COUNT(*) FROM entradas WHERE ID_Funcion = ? AND ID_Asiento = ?";
            $stm = $this->pdo->prepare($sqlCheck);
            $stm->execute([$e->getIDFuncion(), $e->getIDAsiento()]);
            if ($stm->fetchColumn() > 0) {
                $this->pdo->rollBack();
                throw new Exception("El asiento seleccionado ya está ocupado.");
            }

            // 2) insertar entrada
            $sql = "INSERT INTO entradas (fecha, ID_Funcion, ID_Usuario, ID_Asiento)
                    VALUES (?, ?, ?, ?)";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $e->getFecha(),
                $e->getIDFuncion(),
                $e->getIdUsuario(),
                $e->getIDAsiento()
            ]);

            $id = $this->pdo->lastInsertId();
            $this->pdo->commit();
            return $id;
        } catch (Exception $ex) {
            if ($this->pdo->inTransaction()) $this->pdo->rollBack();
            throw $ex;
        }
    }

    // Get IDs de asientos ocupados por función
    public function AsientosOcupadosPorFuncion(int $ID_Funcion): array {
        $res = [];
        $sql = "SELECT ID_Asiento FROM entradas WHERE ID_Funcion = ?";
        $stm = $this->pdo->prepare($sql);
        $stm->execute([$ID_Funcion]);
        foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) $res[] = (int)$r->ID_Asiento;
        return $res;
    }
}
