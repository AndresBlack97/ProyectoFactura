<?php
// Incluir el controlador VendedorController
require_once '../controlador/VendedorController.php';

// Crear una instancia del controlador
$vendedorController = new VendedorController();

// Obtener el código del vendedor desde la URL
$codigo = $_GET['id'];

// Eliminar el vendedor
$resultado = $vendedorController->delete($codigo);

// Redirigir a la lista de vendedores con un mensaje
header("Location: vendedor.php?mensaje=" . urlencode($resultado));
exit;
?>