
<?php
require_once __DIR__ . '/../modelo/cliente.php';
require_once __DIR__ . '/../config/Database.php';

class ClienteController {
    private $db;
    private $cliente;

    public function __construct() {
        // Obtener la conexión a la base de datos
        $database = new Database();
        $this->db = $database->getConnection();

        // Crear una instancia del modelo Cliente
        $this->cliente = new Cliente($this->db);
    }

    // Método para crear un cliente
    public function create($codigo_cliente, $email, $nombre, $telefono, $credito) {
        $this->cliente->codigo_cliente = $codigo_cliente; // Cambiado de $codigo a $codigo_cliente
        $this->cliente->email = $email;
        $this->cliente->nombre = $nombre;
        $this->cliente->telefono = $telefono;
        $this->cliente->credito = $credito;

        if ($this->cliente->create()) {
            return "Cliente creado correctamente.";
        } else {
            return "Error al crear el cliente.";
        }
    }

    // Método para leer un cliente por código
    public function readOne($codigo_cliente) { // Cambiado de $codigo a $codigo_cliente
        $this->cliente->codigo_cliente = $codigo_cliente; // Cambiado de $codigo a $codigo_cliente
        $this->cliente->readOne();

        if ($this->cliente->nombre != null) {
            return $this->cliente;
        } else {
            return "Cliente no encontrado.";
        }
    }

    // Método para actualizar un cliente
    public function update($codigo_cliente, $email, $nombre, $telefono, $credito) { // Cambiado de $codigo a $codigo_cliente
        $this->cliente->codigo_cliente = $codigo_cliente; // Cambiado de $codigo a $codigo_cliente
        $this->cliente->email = $email;
        $this->cliente->nombre = $nombre;
        $this->cliente->telefono = $telefono;
        $this->cliente->credito = $credito;

        if ($this->cliente->update()) {
            return "Cliente actualizado correctamente.";
        } else {
            return "Error al actualizar el cliente.";
        }
    }

    // Método para eliminar un cliente
    public function delete($codigo_cliente) { // Cambiado de $codigo a $codigo_cliente
        $this->cliente->codigo_cliente = $codigo_cliente; // Cambiado de $codigo a $codigo_cliente

        if ($this->cliente->delete()) {
            return "Cliente eliminado correctamente.";
        } else {
            return "Error al eliminar el cliente.";
        }
    }

    // controlador/ClienteController.php
    public function readAll() {
    $query = "SELECT * FROM cliente";
    $stmt = $this->db->prepare($query);
    $stmt->execute();

    $clientes = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $cliente = new Cliente($this->db);
        $cliente->codigo_cliente = $row['codigo_cliente'];
        $cliente->email = $row['email'];
        $cliente->nombre = $row['nombre'];
        $cliente->telefono = $row['telefono'];
        $cliente->credito = $row['credito'];
        $clientes[] = $cliente;
    }

    return $clientes;
}
}
?>