<?php
class Conexion {
    private $host = "localhost";       
    private $db = "proyecto_cine";   
    private $usuario = "root";         
    private $clave = "";  
    private $charset = "utf8mb4";
    private $pdo;

    public function __construct() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
            
            $opciones = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false
            ];

            $this->pdo = new PDO($dsn, $this->usuario, $this->clave, $opciones);

        } catch (PDOException $e) {
            // Mensaje más legible para debug
            die("⚠️ Error al conectar a la base de datos:<br>" . $e->getMessage());
        }
    }

    public function getConexion() {
        return $this->pdo;
    }
}
?>
