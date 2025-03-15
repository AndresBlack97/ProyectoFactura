<?php
require_once '../controlador/ClienteController.php';

$clienteController = new ClienteController();

// Obtener el código del cliente a editar
$codigo_cliente = $_GET['id'];

// Obtener los datos del cliente
$cliente = $clienteController->readOne($codigo_cliente);

// Procesar el formulario de actualización
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $credito = $_POST['credito'];

    $resultado = $clienteController->update($codigo_cliente, $email, $nombre, $telefono, $credito);
    echo "<p>$resultado</p>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
</head>
<body>
    <h1>Editar Cliente</h1>
    <form method="POST" action="">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $cliente->email; ?>" required><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $cliente->nombre; ?>" required><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" value="<?php echo $cliente->telefono; ?>" required><br>

        <label for="credito">Crédito:</label>
        <input type="number" id="credito" name="credito" step="0.01" value="<?php echo $cliente->credito; ?>" required><br>

        <button type="submit">Actualizar Cliente</button>
    </form>
    <a href="cliente.php">Volver a la lista de clientes</a>
</body>
</html>