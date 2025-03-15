<?php
require_once __DIR__ . '/../modelo/Persona.php';
require_once __DIR__ . '/../config/Database.php';

class PersonaController {
    private $db;
    private $persona;

    public function __construct() {
        // Obtener la conexión a la base de datos
        $database = new Database();
        $this->db = $database->getConnection();

        // Crear una instancia del modelo Persona
        $this->persona = new Persona($this->db);
    }

    // Método para crear una persona
    public function create($codigo, $email, $nombre, $telefono) {
        $this->persona->codigo = $codigo;
        $this->persona->email = $email;
        $this->persona->nombre = $nombre;
        $this->persona->telefono = $telefono;

        $query = "INSERT INTO " . $this->persona->getTableName() . " (codigo, email, nombre, telefono) VALUES (:codigo, :email, :nombre, :telefono)";
        $stmt = $this->db->prepare($query);

        // Limpiar y vincular los datos
        $this->persona->codigo = htmlspecialchars(strip_tags($this->persona->codigo));
        $this->persona->email = htmlspecialchars(strip_tags($this->persona->email));
        $this->persona->nombre = htmlspecialchars(strip_tags($this->persona->nombre));
        $this->persona->telefono = htmlspecialchars(strip_tags($this->persona->telefono));

        $stmt->bindParam(":codigo", $this->persona->codigo);
        $stmt->bindParam(":email", $this->persona->email);
        $stmt->bindParam(":nombre", $this->persona->nombre);
        $stmt->bindParam(":telefono", $this->persona->telefono);

        if ($stmt->execute()) {
            return "Persona creada correctamente.";
        } else {
            return "Error al crear la persona.";
        }
    }

    // Método para leer una persona por código
    public function readOne($codigo) {
        $query = "SELECT * FROM " . $this->persona->getTableName() . " WHERE codigo = ? LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $codigo);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->persona->codigo = $row['codigo'];
            $this->persona->email = $row['email'];
            $this->persona->nombre = $row['nombre'];
            $this->persona->telefono = $row['telefono'];
            return $this->persona;
        } else {
            return "Persona no encontrada.";
        }
    }

    // Método para actualizar una persona
    public function update($codigo, $email, $nombre, $telefono) {
        $this->persona->codigo = $codigo;
        $this->persona->email = $email;
        $this->persona->nombre = $nombre;
        $this->persona->telefono = $telefono;

        $query = "UPDATE " . $this->persona->getTableName() . " SET email = :email, nombre = :nombre, telefono = :telefono WHERE codigo = :codigo";
        $stmt = $this->db->prepare($query);

        // Limpiar y vincular los datos
        $this->persona->email = htmlspecialchars(strip_tags($this->persona->email));
        $this->persona->nombre = htmlspecialchars(strip_tags($this->persona->nombre));
        $this->persona->telefono = htmlspecialchars(strip_tags($this->persona->telefono));
        $this->persona->codigo = htmlspecialchars(strip_tags($this->persona->codigo));

        $stmt->bindParam(":email", $this->persona->email);
        $stmt->bindParam(":nombre", $this->persona->nombre);
        $stmt->bindParam(":telefono", $this->persona->telefono);
        $stmt->bindParam(":codigo", $this->persona->codigo);

        if ($stmt->execute()) {
            return "Persona actualizada correctamente.";
        } else {
            return "Error al actualizar la persona.";
        }
    }

    // Método para eliminar una persona
    public function delete($codigo) {
        $query = "DELETE FROM " . $this->persona->getTableName() . " WHERE codigo = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $codigo);

        if ($stmt->execute()) {
            return "Persona eliminada correctamente.";
        } else {
            return "Error al eliminar la persona.";
        }
    }

    // Método para leer todas las personas
    public function readAll() {
        $query = "SELECT * FROM " . $this->persona->getTableName();
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $personas = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $persona = new Persona($this->db);
            $persona->codigo = $row['codigo'];
            $persona->email = $row['email'];
            $persona->nombre = $row['nombre'];
            $persona->telefono = $row['telefono'];
            $personas[] = $persona;
        }

        return $personas;
    }
}
?>