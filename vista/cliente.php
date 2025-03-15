<?php
// Incluir el controlador ClienteController
require_once '../controlador/ClienteController.php'; // Para incluir el controlador
require_once __DIR__ . '/../vista/Cliente.php';     // Para incluir la vista

// Crear una instancia del controlador
$clienteController = new ClienteController();

// Procesar el formulario de creación de cliente
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo_cliente = $_POST['codigo_cliente'];
    $email = $_POST['email'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $credito = $_POST['credito'];

    // Crear el cliente
    $resultado = $clienteController->create($codigo_cliente, $email, $nombre, $telefono, $credito);
    echo "<p>$resultado</p>";
}

// Obtener la lista de clientes
$clientes = $clienteController->readAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Gestión de Clientes</h1>

    <!-- Formulario para crear un cliente -->
    <h2>Crear Nuevo Cliente</h2>
    <form method="POST" action="">
        <label for="codigo_cliente">Código:</label>
        <input type="text" id="codigo_cliente" name="codigo_cliente" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" required><br>

        <label for="credito">Crédito:</label>
        <input type="number" id="credito" name="credito" step="0.01" required><br>

        <button type="submit">Crear Cliente</button>
    </form>

    <!-- Lista de clientes -->
    <h2>Lista de Clientes</h2>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Email</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Crédito</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($clientes)): ?>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td><?php echo $cliente->codigo_cliente; ?></td>
                        <td><?php echo $cliente->email; ?></td>
                        <td><?php echo $cliente->nombre; ?></td>
                        <td><?php echo $cliente->telefono; ?></td>
                        <td><?php echo $cliente->credito; ?></td>
                        <td>
                            <a href="editar_cliente.php?id=<?php echo $cliente->codigo_cliente; ?>">Editar</a>
                            <a href="eliminar_cliente.php?id=<?php echo $cliente->codigo_cliente; ?>" onclick="return confirm('¿Estás seguro de eliminar este cliente?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No hay clientes registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>