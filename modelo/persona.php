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
}
?>