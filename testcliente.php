<?php
// testCliente.php
require_once 'controlador/ClienteController.php';

$clienteController = new ClienteController();

// Datos de prueba
$codigo_cliente = "C003"; // Cambiado de $codigo a $codigo_cliente
$email = "cliente3@example.com";
$nombre = "Pedro Gómez";
$telefono = "555-1234";
$credito = 500.0;

// 1. Crear un cliente
echo "Creando un cliente...<br>";
$resultado = $clienteController->create($codigo_cliente, $email, $nombre, $telefono, $credito);
echo $resultado . "<br>"; // Debe mostrar: "Cliente creado correctamente."

// 2. Leer el cliente recién creado
echo "Leyendo el cliente...<br>";
$cliente = $clienteController->readOne($codigo_cliente);
if (is_object($cliente)) {
    echo "Cliente encontrado: " . $cliente->nombre . "<br>";
} else {
    echo $cliente . "<br>"; // Debe mostrar: "Cliente no encontrado."
}

// 3. Actualizar el cliente
echo "Actualizando el cliente...<br>";
$nuevoCredito = 750.0;
$resultado = $clienteController->update($codigo_cliente, $email, $nombre, $telefono, $nuevoCredito);
echo $resultado . "<br>"; // Debe mostrar: "Cliente actualizado correctamente."

// 4. Eliminar el cliente
echo "Eliminando el cliente...<br>";
$resultado = $clienteController->delete($codigo_cliente);
echo $resultado . "<br>"; // Debe mostrar: "Cliente eliminado correctamente."

// 5. Intentar leer el cliente eliminado
echo "Intentando leer el cliente eliminado...<br>";
$cliente = $clienteController->readOne($codigo_cliente);
if (is_object($cliente)) {
    echo "Cliente encontrado: " . $cliente->nombre . "<br>";
} else {
    echo $cliente . "<br>"; // Debe mostrar: "Cliente no encontrado."
}
?>