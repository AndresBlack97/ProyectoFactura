<?php
require_once __DIR__ . '/../modelo/Factura.php';
require_once __DIR__ . '/../modelo/Cliente.php';
require_once __DIR__ . '/../modelo/Vendedor.php';
require_once __DIR__ . '/../config/Database.php';

class FacturaController {
    private $db;
    private $factura;

    public function __construct() {
        // Obtener la conexión a la base de datos
        $database = new Database();
        $this->db = $database->getConnection();

        // Crear una instancia del modelo Factura
        $this->factura = new Factura("", 0, 0.0, new Cliente($this->db), new Vendedor($this->db));
    }

    // Método para crear una factura
    public function create($fecha, $numero, $total, $cliente, $vendedor) {
        $this->factura->setFecha($fecha);
        $this->factura->setNumero($numero);
        $this->factura->setTotal($total);
        $this->factura->setCliente($cliente);
        $this->factura->setVendedor($vendedor);

        // Aquí iría la lógica para guardar la factura en la base de datos
        // Por ejemplo:
        $query = "INSERT INTO factura (fecha, numero, total, cliente_id, vendedor_id) VALUES (:fecha, :numero, :total, :cliente_id, :vendedor_id)";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(":fecha", $this->factura->getFecha());
        $stmt->bindParam(":numero", $this->factura->getNumero());
        $stmt->bindParam(":total", $this->factura->getTotal());
        $stmt->bindParam(":cliente_id", $this->factura->getCliente()->getId());
        $stmt->bindParam(":vendedor_id", $this->factura->getVendedor()->getId());

        if ($stmt->execute()) {
            return "Factura creada correctamente.";
        } else {
            return "Error al crear la factura.";
        }
    }

    // Método para leer una factura por número
    public function readOne($numero) {
        $query = "SELECT * FROM factura WHERE numero = ? LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $numero);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->factura->setFecha($row['fecha']);
            $this->factura->setNumero($row['numero']);
            $this->factura->setTotal($row['total']);
            // Aquí deberías cargar el cliente y el vendedor desde la base de datos
            return $this->factura;
        } else {
            return "Factura no encontrada.";
        }
    }

    // Método para actualizar una factura
    public function update($numero, $fecha, $total, $cliente, $vendedor) {
        $this->factura->setNumero($numero);
        $this->factura->setFecha($fecha);
        $this->factura->setTotal($total);
        $this->factura->setCliente($cliente);
        $this->factura->setVendedor($vendedor);

        $query = "UPDATE factura SET fecha = :fecha, total = :total, cliente_id = :cliente_id, vendedor_id = :vendedor_id WHERE numero = :numero";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(":fecha", $this->factura->getFecha());
        $stmt->bindParam(":total", $this->factura->getTotal());
        $stmt->bindParam(":cliente_id", $this->factura->getCliente()->getId());
        $stmt->bindParam(":vendedor_id", $this->factura->getVendedor()->getId());
        $stmt->bindParam(":numero", $this->factura->getNumero());

        if ($stmt->execute()) {
            return "Factura actualizada correctamente.";
        } else {
            return "Error al actualizar la factura.";
        }
    }

    // Método para eliminar una factura
    public function delete($numero) {
        $query = "DELETE FROM factura WHERE numero = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $numero);

        if ($stmt->execute()) {
            return "Factura eliminada correctamente.";
        } else {
            return "Error al eliminar la factura.";
        }
    }

    // Método para leer todas las facturas
    public function readAll() {
        $query = "SELECT * FROM factura";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $facturas = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $factura = new Factura($row['fecha'], $row['numero'], $row['total'], new Cliente($this->db), new Vendedor($this->db));
            $facturas[] = $factura;
        }

        return $facturas;
    }
}
?>