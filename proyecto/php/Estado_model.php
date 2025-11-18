<?php
require_once "Conexion.php";
require_once "Estado.php";

class EstadoModel {

    public function listar() {
        $conexion = new Conexion();
        $cn = $conexion->getConexion(); // Obtener la conexión PDO

        $sql = $cn->query("SELECT * FROM estado_pelicula");

        $lista = [];
        while ($fila = $sql->fetch(PDO::FETCH_ASSOC)) {
            $estado = new Estado();
            $estado->setidestado($fila["id_estado"]);
            $estado->setnombre($fila["nombre"]);
            $lista[] = $estado;
        }
        return $lista;
    }
}
