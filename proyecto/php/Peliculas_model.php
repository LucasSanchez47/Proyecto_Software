<?php
require_once 'Conexion.php';
require_once 'Peliculas.php';

class PeliculaModel {

    public function listar() {
        $conexion = new Conexion();
        $cn = $conexion->getConexion();

        $stmt = $cn->query("SELECT * FROM peliculas");

        $lista = [];

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $p = new Pelicula();
            $p->setidpelicula($fila["ID_peliculas"]);
            $p->settitulo($fila["titulo"]);
            $p->setdescripcion($fila["descripcion"]);
            $p->setduracion($fila["duracion"]);
            $p->setgenero($fila["genero"]);
            $p->setposter($fila["poster"]);
            $p->setestreno($fila["estreno"]);
            $p->setidestado($fila["id_estado"]);
            $lista[] = $p;
        }

        return $lista;
    }

    public function obtenerEstrenos($limite = 3) {
        $conexion = new Conexion();
        $cn = $conexion->getConexion();

        $sql = "SELECT * FROM peliculas WHERE id_estado = 1 
                ORDER BY estreno DESC LIMIT ?";
    
        $stmt = $cn->prepare($sql);
        $stmt->bindValue(1, (int)$limite, PDO::PARAM_INT);
        $stmt->execute();

        $lista = [];

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $p = new Pelicula();
            $p->setidpelicula($fila["ID_peliculas"]);
            $p->settitulo($fila["titulo"]);
            $p->setdescripcion($fila["descripcion"]);
            $p->setduracion($fila["duracion"]);
            $p->setgenero($fila["genero"]);
            $p->setposter($fila["poster"]);
            $p->setestreno($fila["estreno"]);
            $p->setidestado($fila["id_estado"]);
            $lista[] = $p;
        }

        return $lista;
    }

    public function registrar(Pelicula $p) {
        $conexion = new Conexion();
        $cn = $conexion->getConexion();

        $sql = "INSERT INTO peliculas (titulo, descripcion, duracion, genero, poster, estreno, id_estado)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $cn->prepare($sql);
        return $stmt->execute([
            $p->gettitulo(),
            $p->getdescripcion(),
            $p->getduracion(),
            $p->getgenero(),
            $p->getposter(),
            $p->getestreno(),
            $p->getidestado()
        ]);
    }

    public function actualizar(Pelicula $p) {
        $conexion = new Conexion();
        $cn = $conexion->getConexion();

        $sql = "UPDATE peliculas SET 
                titulo=?, descripcion=?, duracion=?, genero=?, poster=?, estreno=?, id_estado=?
                WHERE ID_peliculas=?";

        $stmt = $cn->prepare($sql);
        return $stmt->execute([
            $p->gettitulo(),
            $p->getdescripcion(),
            $p->getduracion(),
            $p->getgenero(),
            $p->getposter(),
            $p->getestreno(),
            $p->getidestado(),
            $p->getidpelicula()
        ]);
    }

    public function eliminar($id) {
        $conexion = new Conexion();
        $cn = $conexion->getConexion();

        $sql = "DELETE FROM peliculas WHERE ID_peliculas=?";
        $stmt = $cn->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function obtenerPreventas($limite = 3) {
    $conexion = new Conexion();
    $cn = $conexion->getConexion();

    $sql = "SELECT * FROM peliculas WHERE id_estado = 2 
            ORDER BY estreno DESC LIMIT ?";

    $stmt = $cn->prepare($sql);
    $stmt->bindValue(1, (int)$limite, PDO::PARAM_INT);
    $stmt->execute();

    $lista = [];

    while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $p = new Pelicula();
        $p->setidpelicula($fila["ID_peliculas"]);
        $p->settitulo($fila["titulo"]);
        $p->setdescripcion($fila["descripcion"]);
        $p->setduracion($fila["duracion"]);
        $p->setgenero($fila["genero"]);
        $p->setposter($fila["poster"]);
        $p->setestreno($fila["estreno"]);
        $p->setidestado($fila["id_estado"]);
        $lista[] = $p;
    }

    return $lista;
}

public function obtenerProximos($limite = 3) {
    $conexion = new Conexion();
    $cn = $conexion->getConexion();

    $sql = "SELECT * FROM peliculas WHERE id_estado = 3 
            ORDER BY estreno DESC LIMIT ?";

    $stmt = $cn->prepare($sql);
    $stmt->bindValue(1, (int)$limite, PDO::PARAM_INT);
    $stmt->execute();

    $lista = [];

    while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $p = new Pelicula();
        $p->setidpelicula($fila["ID_peliculas"]);
        $p->settitulo($fila["titulo"]);
        $p->setdescripcion($fila["descripcion"]);
        $p->setduracion($fila["duracion"]);
        $p->setgenero($fila["genero"]);
        $p->setposter($fila["poster"]);
        $p->setestreno($fila["estreno"]);
        $p->setidestado($fila["id_estado"]);
        $lista[] = $p;
    }

    return $lista;
}

}
?>
