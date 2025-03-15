<?php
// Ruta correcta para incluir EmpresaController.php
require_once __DIR__ . '/controlador/empresacontroller.php';
require_once __DIR__ . '/modelo/Empresa.php';
require_once __DIR__ . '/config/Database.php';


// Crear una instancia del controlador
$empresaController = new EmpresaController();

// Probar la creación de una empresa
$codigo_empresa = "12345"; // Este código debe existir en la tabla persona
$nombre_empresa = "Empresa de Prueba";

$resultado = $empresaController->create($codigo_empresa, $nombre_empresa);
echo $resultado . "<br>";

// Probar la lectura de una empresa
$empresa = $empresaController->readOne($codigo_empresa);
if ($empresa instanceof Empresa) {
    echo "Empresa encontrada: " . $empresa->nombre . "<br>";
} else {
    echo $empresa . "<br>"; // Mostrar el mensaje de error
}

// Probar la lectura de todas las empresas
$empresas = $empresaController->readAll();
foreach ($empresas as $empresa) {
    echo "Código: " . $empresa->codigo_empresa . ", Nombre: " . $empresa->nombre . "<br>";
}
?>