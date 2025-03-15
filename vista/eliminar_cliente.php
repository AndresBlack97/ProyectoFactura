<?php
require_once '../controlador/ClienteController.php';

$clienteController = new ClienteController();

// Obtener el código del cliente a eliminar
$codigo_cliente = $_GET['id'];

// Eliminar el cliente
$resultado = $clienteController->delete($codigo_cliente);
echo "<p>$resultado</p>";

// Redirigir a la lista de clientes
header("Location: cliente.php");
exit();
?>