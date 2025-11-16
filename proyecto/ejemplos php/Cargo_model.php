<?php
require_once 'Conexion.php';
require_once 'Cargo.php';

class CargoModel {
    private $pdo;

    public function __construct() {
        $conexion = new Conexion();
        $this->pdo = $conexion->getConexion();
    }

    // Listar todos los cargos
    public function ListarTodos(): array {
        try {
            $result = [];
            $stm = $this->pdo->prepare("SELECT * FROM cargos");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $cargo = new Cargo();
                $cargo->setidCargo($r->idCargo);
                $cargo->setCargo($r->Cargo);
                $result[] = $cargo;
            }

            return $result;
        } catch (Exception $e) {
            die("Error al listar cargos: " . $e->getMessage());
        }
    }

    // Listar solo cargos restringidos (ejemplo: id >= 2)
    public function ListarRestringidos(): array {
        try {
            $result = [];
            $stm = $this->pdo->prepare("SELECT * FROM cargos WHERE idCargo >= 2");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $cargo = new Cargo();
                $cargo->setidCargo($r->idCargo);
                $cargo->setCargo($r->Cargo);
                $result[] = $cargo;
            }

            return $result;
        } catch (Exception $e) {
            die("Error al listar cargos restringidos: " . $e->getMessage());
        }
    }

    // Obtener un cargo por ID (opcional)
    public function Obtener(int $idCargo): ?Cargo {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM cargos WHERE idCargo = ?");
            $stm->execute([$idCargo]);
            $r = $stm->fetch(PDO::FETCH_OBJ);

            if ($r) {
                $cargo = new Cargo();
                $cargo->setidCargo($r->idCargo);
                $cargo->setCargo($r->Cargo);
                return $cargo;
            }

            return null;
        } catch (Exception $e) {
            die("Error al obtener cargo: " . $e->getMessage());
        }
    }
}
?>
