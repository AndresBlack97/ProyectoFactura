// modelo/Cliente.php
<?php
class Cliente {
    private $conn;
    private $table_name = "cliente";

    public $codigo_cliente; // Asegúrate de que coincida con la columna en la base de datos
    public $email;          // Asegúrate de que coincida con la columna en la base de datos
    public $nombre;         // Asegúrate de que coincida con la columna en la base de datos
    public $telefono;       // Asegúrate de que coincida con la columna en la base de datos
    public $credito;        // Asegúrate de que coincida con la columna en la base de datos

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para crear un cliente
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (codigo_cliente, email, nombre, telefono, credito) VALUES (:codigo_cliente, :email, :nombre, :telefono, :credito)";
        $stmt = $this->conn->prepare($query);

        // Limpiar y vincular los datos
        $this->codigo_cliente = htmlspecialchars(strip_tags($this->codigo_cliente));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->credito = htmlspecialchars(strip_tags($this->credito));

        $stmt->bindParam(":codigo_cliente", $this->codigo_cliente);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":credito", $this->credito);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para leer un cliente por código
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE codigo_cliente = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->codigo_cliente);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->codigo_cliente = $row['codigo_cliente'];
            $this->email = $row['email'];
            $this->nombre = $row['nombre'];
            $this->telefono = $row['telefono'];
            $this->credito = $row['credito'];
        }
    }

    // Método para actualizar un cliente
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET email = :email, nombre = :nombre, telefono = :telefono, credito = :credito WHERE codigo_cliente = :codigo_cliente";
        $stmt = $this->conn->prepare($query);

        // Limpiar y vincular los datos
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->credito = htmlspecialchars(strip_tags($this->credito));
        $this->codigo_cliente = htmlspecialchars(strip_tags($this->codigo_cliente));

        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":credito", $this->credito);
        $stmt->bindParam(":codigo_cliente", $this->codigo_cliente);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para eliminar un cliente
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE codigo_cliente = ?";
        $stmt = $this->conn->prepare($query);
        $this->codigo_cliente = htmlspecialchars(strip_tags($this->codigo_cliente));
        $stmt->bindParam(1, $this->codigo_cliente);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>