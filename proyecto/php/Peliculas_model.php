<?php
require_once 'Conexion.php';
require_once 'Peliculas.php';

class PeliculaModel {

    public function listar() {
        $conexion = new Conexion();
        $cn = $conexion->getConexion();

        $sql = "SELECT * FROM peliculas";  // tu tabla se llama "pelicula", no "peliculas"
        $stmt = $cn->query($sql);

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

            $lista[] = $p;
        }

        return $lista;
    }

    public function registrar(Pelicula $p) {
        $conexion = new Conexion();
        $cn = $conexion->getConexion();

        $sql = "INSERT INTO peliculas (titulo, descripcion, duracion, genero, poster, estreno)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $cn->prepare($sql);
        return $stmt->execute([
            $p->gettitulo(),
            $p->getdescripcion(),
            $p->getduracion(),
            $p->getgenero(),
            $p->getposter(),
            $p->getestreno()
        ]);
    }

    public function actualizar(Pelicula $p) {
        $conexion = new Conexion();
        $cn = $conexion->getConexion();

        $sql = "UPDATE pelicula SET 
                titulo=?, descripcion=?, duracion=?, genero=?, poster=?, estreno=?
                WHERE idPelicula=?";

        $stmt = $cn->prepare($sql);
        return $stmt->execute([
            $p->gettitulo(),
            $p->getdescripcion(),
            $p->getduracion(),
            $p->getgenero(),
            $p->getposter(),
            $p->getestreno(),
            $p->getidpelicula()
        ]);
    }

    public function eliminar($id) {
        $conexion = new Conexion();
        $cn = $conexion->getConexion();

        $sql = "DELETE FROM peliculas WHERE ID_Peliculas=?";
        $stmt = $cn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
