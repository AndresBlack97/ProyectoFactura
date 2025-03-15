<?php
// Incluir el controlador EmpresaController
require_once '../controlador/EmpresaController.php';

// Crear una instancia del controlador
$empresaController = new EmpresaController();

// Obtener el código de la empresa a eliminar
$codigo_empresa = $_GET['id'];

// Eliminar la empresa
$resultado = $empresaController->delete($codigo_empresa);
echo "<p>$resultado</p>";

// Redirigir a la lista de empresas
header("Location: empresa.php");
exit();
?>