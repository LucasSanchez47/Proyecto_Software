<?php
require_once 'Conexion.php';
require_once 'Funcion.php';

class FuncionModel {
    private $pdo;

    public function __construct(){
        $c = new Conexion();
        $this->pdo = $c->getConexion();
    }

    // Listar funciones con título y sala (para select)
    public function Listar(): array {
        $res = [];

        $sql = "SELECT f.*, p.titulo AS peliculasTitulo, s.sala AS salaNombre
                FROM funciones f
                LEFT JOIN peliculas p ON f.ID_Pelicula = p.ID_peliculas
                LEFT JOIN salas s ON f.ID_Sala = s.ID_sala
                ORDER BY f.fecha, f.horario";

        $stm = $this->pdo->prepare($sql);
        $stm->execute();

        foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
            $f = new Funcion();
            $f->setIDFuncion($r->ID_Funcion);
            $f->setIDPelicula($r->ID_Pelicula);
            $f->setIDSala($r->ID_Sala);
            $f->setFecha($r->fecha);
            $f->setHorario($r->horario);

            // CORREGIDO ✔
            $f->setTitulo($r->peliculasTitulo);
            $f->setSalaNombre($r->salaNombre);

            $res[] = $f;
        }
        return $res;
    }

    // Obtener una función por id
    public function Obtener(int $id): ?Funcion {
        $sql = "SELECT f.*, p.titulo AS titulo, s.sala AS salaNombre
                FROM funciones f
                LEFT JOIN peliculas p ON f.ID_Pelicula = p.ID_peliculas
                LEFT JOIN salas s ON f.ID_Sala = s.ID_sala
                WHERE f.ID_Funcion = ?";

        $stm = $this->pdo->prepare($sql);
        $stm->execute([$id]);
        $r = $stm->fetch(PDO::FETCH_OBJ);

        if (!$r) return null;

        $f = new Funcion();
        $f->setIDFuncion($r->ID_Funcion);
        $f->setIDPelicula($r->ID_Pelicula);
        $f->setIDSala($r->ID_Sala);
        $f->setFecha($r->fecha);
        $f->setHorario($r->horario);

        $f->setTitulo($r->titulo);
        $f->setSalaNombre($r->salaNombre);

        return $f;
    }

    // Crear función (admin)
    public function Crear(Funcion $f){
        $sql = "INSERT INTO funciones (ID_Pelicula, ID_Sala, fecha, horario)
                VALUES (?, ?, ?, ?)";

        $stm = $this->pdo->prepare($sql);
        $stm->execute([
            $f->getIDPelicula(),
            $f->getIDSala(),
            $f->getFecha(),
            $f->getHorario()
        ]);

        return $this->pdo->lastInsertId();
    }
}
