<?php
require_once __DIR__ . '/../modelo/Vendedor.php';
require_once __DIR__ . '/../modelo/Persona.php';
require_once __DIR__ . '/../config/Database.php';

class VendedorController {
    private $db;
    private $vendedor;

    public function __construct() {
        // Obtener la conexión a la base de datos
        $database = new Database();
        $this->db = $database->getConnection();

        // Crear una instancia del modelo Vendedor
        $this->vendedor = new Vendedor("", "", "", "", 0, "");
    }

    // Método para crear un vendedor
    public function create($codigo_vendedor, $email, $nombre, $telefono, $carne, $direccion) {
        $this->vendedor = new Vendedor($codigo_vendedor, $email, $nombre, $telefono, $carne, $direccion);

        $query = "INSERT INTO vendedor (codigo_vendedor, email, nombre, telefono, carne, direccion) VALUES (:codigo_vendedor, :email, :nombre, :telefono, :carne, :direccion)";
        $stmt = $this->db->prepare($query);

        // Limpiar y vincular los datos
        $this->vendedor->setCodigo(htmlspecialchars(strip_tags($this->vendedor->getCodigo())));
        $this->vendedor->setEmail(htmlspecialchars(strip_tags($this->vendedor->getEmail())));
        $this->vendedor->setNombre(htmlspecialchars(strip_tags($this->vendedor->getNombre())));
        $this->vendedor->setTelefono(htmlspecialchars(strip_tags($this->vendedor->getTelefono())));
        $this->vendedor->setCarne(htmlspecialchars(strip_tags($this->vendedor->getCarne())));
        $this->vendedor->setDireccion(htmlspecialchars(strip_tags($this->vendedor->getDireccion())));

        $stmt->bindValue(":codigo_vendedor", $this->vendedor->getCodigo());
        $stmt->bindValue(":email", $this->vendedor->getEmail());
        $stmt->bindValue(":nombre", $this->vendedor->getNombre());
        $stmt->bindValue(":telefono", $this->vendedor->getTelefono());
        $stmt->bindValue(":carne", $this->vendedor->getCarne());
        $stmt->bindValue(":direccion", $this->vendedor->getDireccion());

        if ($stmt->execute()) {
            return "Vendedor creado correctamente.";
        } else {
            return "Error al crear el vendedor.";
        }
    }

    // Método para leer un vendedor por código
    public function readOne($codigo) {
        $query = "SELECT * FROM vendedor WHERE codigo_vendedor = ? LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $codigo);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->vendedor = new Vendedor(
                $row['codigo_vendedor'],
                $row['email'],
                $row['nombre'],
                $row['telefono'],
                $row['carne'],
                $row['direccion']
            );
            return $this->vendedor;
        } else {
            return "Vendedor no encontrado.";
        }
    }

    // Método para actualizar un vendedor
    public function update($codigo_vendedor, $email, $nombre, $telefono, $carne, $direccion) {
        $this->vendedor = new Vendedor($codigo_vendedor, $email, $nombre, $telefono, $carne, $direccion);

        $query = "UPDATE vendedor SET email = :email, nombre = :nombre, telefono = :telefono, carne = :carne, direccion = :direccion WHERE codigo_vendedor = :codigo_vendedor";
        $stmt = $this->db->prepare($query);

        // Limpiar y vincular los datos
        $this->vendedor->setEmail(htmlspecialchars(strip_tags($this->vendedor->getEmail())));
        $this->vendedor->setNombre(htmlspecialchars(strip_tags($this->vendedor->getNombre())));
        $this->vendedor->setTelefono(htmlspecialchars(strip_tags($this->vendedor->getTelefono())));
        $this->vendedor->setCarne(htmlspecialchars(strip_tags($this->vendedor->getCarne())));
        $this->vendedor->setDireccion(htmlspecialchars(strip_tags($this->vendedor->getDireccion())));
        $this->vendedor->setCodigo(htmlspecialchars(strip_tags($this->vendedor->getCodigo())));

        $stmt->bindValue(":email", $this->vendedor->getEmail());
        $stmt->bindValue(":nombre", $this->vendedor->getNombre());
        $stmt->bindValue(":telefono", $this->vendedor->getTelefono());
        $stmt->bindValue(":carne", $this->vendedor->getCarne());
        $stmt->bindValue(":direccion", $this->vendedor->getDireccion());
        $stmt->bindValue(":codigo_vendedor", $this->vendedor->getCodigo());

        if ($stmt->execute()) {
            return "Vendedor actualizado correctamente.";
        } else {
            return "Error al actualizar el vendedor.";
        }
    }

    // Método para eliminar un vendedor
    public function delete($codigo) {
        $query = "DELETE FROM vendedor WHERE codigo_vendedor = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $codigo);

        if ($stmt->execute()) {
            return "Vendedor eliminado correctamente.";
        } else {
            return "Error al eliminar el vendedor.";
        }
    }

    // Método para leer todos los vendedores
    public function readAll() {
        $query = "SELECT * FROM vendedor";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $vendedores = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $vendedor = new Vendedor(
                $row['codigo_vendedor'],
                $row['email'],
                $row['nombre'],
                $row['telefono'],
                $row['carne'],
                $row['direccion']
            );
            $vendedores[] = $vendedor;
        }

        return $vendedores;
    }
}
?>