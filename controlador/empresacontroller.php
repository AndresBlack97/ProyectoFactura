<?php
require_once __DIR__ . '/../modelo/Empresa.php';
require_once __DIR__ . '/../config/Database.php';

class EmpresaController {
    private $db;
    private $empresa;

    public function __construct() {
        // Obtener la conexión a la base de datos
        $database = new Database();
        $this->db = $database->getConnection();

        // Crear una instancia del modelo Empresa
        $this->empresa = new Empresa($this->db);
    }

    // Método para crear una empresa
    public function create($codigo_empresa, $nombre) {
        $this->empresa->codigo_empresa = $codigo_empresa;
        $this->empresa->nombre = $nombre;

        if ($this->empresa->create()) {
            return "Empresa creada correctamente.";
        } else {
            return "Error al crear la empresa.";
        }
    }

    // Método para leer una empresa por código
    public function readOne($codigo_empresa) {
        $this->empresa->codigo_empresa = $codigo_empresa;
        $this->empresa->readOne();

        if ($this->empresa->nombre != null) {
            return $this->empresa;
        } else {
            return "Empresa no encontrada.";
        }
    }

    // Método para leer todas las empresas
    public function readAll() {
        return $this->empresa->readAll();
    }
}
?>