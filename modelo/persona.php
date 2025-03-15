<?php
class Persona {
    protected $conn;
    protected $table_name = "persona"; 

    public $codigo;
    public $email;
    public $nombre;
    public $telefono;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método getter para table_name
    public function getTableName() {
        return $this->table_name;
    }

    public function getCodigo() { return $this->codigo; }
    public function getEmail() { return $this->email; }
    public function getNombre() { return $this->nombre; }
    public function getTelefono() { return $this->telefono; }

    // Métodos SET
    public function setCodigo($codigo) { $this->codigo = $codigo; }
    public function setEmail($email) { $this->email = $email; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setTelefono($telefono) { $this->telefono = $telefono; }

}
?>