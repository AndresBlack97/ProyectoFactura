<?php
class Empresa {
    private $conn;
    private $table_name = "empresa";

    public $codigo_empresa;
    public $nombre;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para crear una empresa
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (codigo_empresa, nombre) VALUES (:codigo_empresa, :nombre)";
        $stmt = $this->conn->prepare($query);

        // Limpiar y vincular los datos
        $this->codigo_empresa = htmlspecialchars(strip_tags($this->codigo_empresa));
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));

        $stmt->bindParam(":codigo_empresa", $this->codigo_empresa);
        $stmt->bindParam(":nombre", $this->nombre);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para leer una empresa por código
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE codigo_empresa = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->codigo_empresa);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->codigo_empresa = $row['codigo_empresa'];
            $this->nombre = $row['nombre'];
        }
    }

    // Método para actualizar una empresa
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nombre = :nombre WHERE codigo_empresa = :codigo_empresa";
        $stmt = $this->conn->prepare($query);

        // Limpiar y vincular los datos
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->codigo_empresa = htmlspecialchars(strip_tags($this->codigo_empresa));

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":codigo_empresa", $this->codigo_empresa);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para eliminar una empresa
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE codigo_empresa = ?";
        $stmt = $this->conn->prepare($query);
        $this->codigo_empresa = htmlspecialchars(strip_tags($this->codigo_empresa));
        $stmt->bindParam(1, $this->codigo_empresa);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para leer todas las empresas
    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $empresas = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $empresa = new Empresa($this->conn);
            $empresa->codigo_empresa = $row['codigo_empresa'];
            $empresa->nombre = $row['nombre'];
            $empresas[] = $empresa;
        }

        return $empresas;
    }
}
?>
