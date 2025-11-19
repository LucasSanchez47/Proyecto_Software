<?php
require_once "Conexion.php";

class ProductoModel {

    private $pdo;

    public function __construct() {
        $this->pdo = (new Conexion())->getConexion();
    }

    public function listar() {
        $sql = $this->pdo->prepare("SELECT * FROM productos ORDER BY idproducto DESC");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }

    public function obtener($id) {
        $sql = $this->pdo->prepare("SELECT * FROM productos WHERE idproducto = ?");
        $sql->execute([$id]);
        return $sql->fetch(PDO::FETCH_OBJ);
    }

    public function guardar($data) {

        if (!empty($data["idproducto"])) {
            // UPDATE
            $sql = $this->pdo->prepare("
                UPDATE productos 
                SET nombre=?, cantidad=?, categoria=?, precio=?, descripcion=?, imagen=?, estado=?
                WHERE idproducto=?
            ");

            return $sql->execute([
                $data["nombre"],
                $data["cantidad"],
                $data["categoria"],
                $data["precio"],
                $data["descripcion"],
                $data["imagen"],
                $data["estado"],
                $data["idproducto"]
            ]);

        } else {
            // INSERT
            $sql = $this->pdo->prepare("
                INSERT INTO productos (nombre, cantidad, categoria, precio, descripcion, imagen, estado)
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ");

            return $sql->execute([
                $data["nombre"],
                $data["cantidad"],
                $data["categoria"],
                $data["precio"],
                $data["descripcion"],
                $data["imagen"],
                $data["estado"]
            ]);
        }
    }

    public function eliminar($id) {
        $sql = $this->pdo->prepare("DELETE FROM productos WHERE idproducto = ?");
        return $sql->execute([$id]);
    }
}
