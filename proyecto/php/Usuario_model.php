<?php
include_once("Conexion.php");
include_once("Usuario.php");
include_once("Cargo.php");
include_once("Cargo_model.php");

class UsuarioModel {
    private $pdo;

    public function __construct() {
        $conexion = new Conexion();
        $this->pdo = $conexion->getConexion();
    }

    // ===========================
    // LISTAR
    // ===========================
    public function Listar(): array {
        try {
            $result = [];
            $stm = $this->pdo->prepare("
                SELECT u.ID_usuario, u.Nombre, u.Apellido, u.Direccion, 
                        u.Num_telefono, u.Correo, c.Cargo
                FROM usuarios u
                INNER JOIN cargos c ON u.ID_cargo = c.ID_cargo
            ");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $usuario = new Usuario();
                $usuario->setidusuario($r->ID_usuario);
                $usuario->setnombre($r->Nombre);
                $usuario->setapellido($r->Apellido);
                $usuario->setdireccion($r->Direccion);
                $usuario->settelefono($r->Num_telefono);
                $usuario->setcorreo($r->Correo);
                $usuario->setcargo($r->Cargo);

                $result[] = $usuario;
            }
            return $result;

        } catch (Exception $e) {
            die("Error al listar usuarios: " . $e->getMessage());
        }
    }

    // ===========================
    // OBTENER UNO
    // ===========================
    public function Obtener(int $idUsuario): ?Usuario {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM usuarios WHERE ID_usuario = ?");
            $stm->execute([$idUsuario]);
            $r = $stm->fetch(PDO::FETCH_OBJ);

            if ($r) {
                $usuario = new Usuario();
                $usuario->setidusuario($r->ID_usuario);
                $usuario->setnombre($r->Nombre);
                $usuario->setapellido($r->Apellido);
                $usuario->setdireccion($r->Direccion);
                $usuario->settelefono($r->Num_telefono);
                $usuario->setcorreo($r->Correo);
                $usuario->setclave($r->Contrasenia);
                $usuario->setidcargo($r->ID_cargo);
                $usuario->setfotoperfil($r->Foto_perfil);

                return $usuario;
            }

            return null;

        } catch (Exception $e) {
            die("Error al obtener usuario: " . $e->getMessage());
        }
    }

    // ===========================
    // ELIMINAR
    // ===========================
    public function Eliminar(int $idUsuario): void {
        try {
            $stm = $this->pdo->prepare("DELETE FROM usuarios WHERE ID_usuario = ?");
            $stm->execute([$idUsuario]);

        } catch (Exception $e) {
            die("Error al eliminar usuario: " . $e->getMessage());
        }
    }

    // ===========================
    // ACTUALIZAR
    // ===========================
    public function Actualizar(Usuario $data): void {
        try {
            $sql = "
                UPDATE usuarios SET 
                    Nombre = ?, 
                    Apellido = ?, 
                    Direccion = ?, 
                    Num_telefono = ?, 
                    Correo = ?, 
                    ID_cargo = ?
            ";

            $params = [
                $data->getnombre(),
                $data->getapellido(),
                $data->getdireccion(),
                $data->gettelefono(),
                $data->getcorreo(),
                $data->getidcargo()
            ];

            // Si actualiza contraseña
            if (!empty($data->getclave())) {
                $sql .= ", Contrasenia = ?";
                $params[] = $data->getclave();
            }

            // Si actualiza foto
            if (!empty($data->getfotoperfil())) {
                $sql .= ", Foto_perfil = ?";
                $params[] = $data->getfotoperfil();
            }

            // WHERE
            $sql .= " WHERE ID_usuario = ?";
            $params[] = $data->getidusuario();

            $this->pdo->prepare($sql)->execute($params);

        } catch (Exception $e) {
            die("Error al actualizar usuario: " . $e->getMessage());
        }
    }

    // ===========================
    // REGISTRAR
    // ===========================
    public function Registrar(Usuario $data): void {
        try {
            $sql = "
                INSERT INTO usuarios 
                (Nombre, Apellido, Direccion, Num_telefono, Correo, ID_cargo, Contrasenia) 
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ";

            $this->pdo->prepare($sql)->execute([
                $data->getnombre(),
                $data->getapellido(),
                $data->getdireccion(),
                $data->gettelefono(),
                $data->getcorreo(),
                $data->getidcargo(),
                password_hash($data->getclave(), PASSWORD_DEFAULT)   // HASHED
            ]);

        } catch (Exception $e) {
            die("Error al registrar usuario: " . $e->getMessage());
        }
    }

    // ===========================
    // LOGIN
    // ===========================
    public function Login(Usuario $data): ?Usuario {
        try {
            $sql = "
                SELECT u.ID_usuario, u.Nombre, u.Apellido, u.Direccion, 
                        u.Num_telefono, u.Correo, u.Contrasenia, 
                        u.ID_cargo, c.Cargo, u.Foto_perfil
                FROM usuarios u
                INNER JOIN cargos c ON u.ID_cargo = c.ID_cargo
                WHERE u.Correo = ?
            ";

            $stm = $this->pdo->prepare($sql);
            $stm->execute([$data->getcorreo()]);
            $r = $stm->fetch(PDO::FETCH_OBJ);

            if ($r && password_verify($data->getclave(), $r->Contrasenia)) {
                $user = new Usuario();
                $user->setidusuario($r->ID_usuario);
                $user->setnombre($r->Nombre);
                $user->setapellido($r->Apellido);
                $user->setdireccion($r->Direccion);
                $user->settelefono($r->Num_telefono);
                $user->setcorreo($r->Correo);
                $user->setidcargo($r->ID_cargo);
                $user->setcargo($r->Cargo);
                $user->setfotoperfil($r->Foto_perfil);

                return $user;
            }

            return null;

        } catch (Exception $e) {
            die("Error al hacer login: " . $e->getMessage());
        }
    }

    // ===========================
    // BUSCAR
    // ===========================
    public function Buscar(string $termino): array {
        try {
            $result = [];
            $sql = "
                SELECT * FROM usuarios
                WHERE Nombre LIKE :t OR Apellido LIKE :t OR Correo LIKE :t
            ";
            $stm = $this->pdo->prepare($sql);
            $like = '%' . $termino . '%';
            $stm->bindParam(':t', $like, PDO::PARAM_STR);
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $usuario = new Usuario();
                $usuario->setidusuario($r->ID_usuario);
                $usuario->setnombre($r->Nombre);
                $usuario->setapellido($r->Apellido);
                $usuario->setdireccion($r->Direccion);
                $usuario->settelefono($r->Num_telefono);
                $usuario->setcorreo($r->Correo);
                $usuario->setidcargo($r->ID_cargo);

                $result[] = $usuario;
            }

            return $result;

        } catch (Exception $e) {
            die("Error al buscar usuario: " . $e->getMessage());
        }
    }
}
?>
