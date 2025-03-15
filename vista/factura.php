<?php
// Incluir el controlador FacturaController
require_once '../controlador/FacturaController.php';

// Crear una instancia del controlador
$facturaController = new FacturaController();

// Procesar el formulario de creación de factura
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha = $_POST['fecha'];
    $numero = $_POST['numero'];
    $total = $_POST['total'];
    $cliente_id = $_POST['cliente_id'];
    $vendedor_id = $_POST['vendedor_id'];

    // Crear la factura
    $resultado = $facturaController->create($fecha, $numero, $total, $cliente_id, $vendedor_id);
    echo "<p>$resultado</p>";
}

// Obtener la lista de facturas
$facturas = $facturaController->readAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Facturas</title>
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
    <h1>Gestión de Facturas</h1>

    <!-- Formulario para crear una factura -->
    <h2>Crear Nueva Factura</h2>
    <form method="POST" action="">
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required><br>

        <label for="numero">Número:</label>
        <input type="number" id="numero" name="numero" required><br>

        <label for="total">Total:</label>
        <input type="number" id="total" name="total" step="0.01" required><br>

        <label for="cliente_id">Código Cliente:</label>
        <input type="number" id="cliente_id" name="cliente_id" required><br>

        <label for="vendedor_id">Código Vendedor:</label>
        <input type="number" id="vendedor_id" name="vendedor_id" required><br>

        <button type="submit">Crear Factura</button>
    </form>

    <!-- Lista de facturas -->
    <h2>Lista de Facturas</h2>
    <table>
        <thead>
            <tr>
                <th>Número</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Cliente</th>
                <th>Vendedor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($facturas)): ?>
                <?php foreach ($facturas as $factura): ?>
                    <tr>
                        <td><?php echo $factura->getNumero(); ?></td>
                        <td><?php echo $factura->getFecha(); ?></td>
                        <td><?php echo $factura->getTotal(); ?></td>
                        <td><?php echo $factura->getCliente()->getNombre(); ?></td>
                        <td><?php echo $factura->getVendedor()->getNombre(); ?></td>
                        <td>
                            <a href="editar_factura.php?id=<?php echo $factura->getNumero(); ?>">Editar</a>
                            <a href="eliminar_factura.php?id=<?php echo $factura->getNumero(); ?>" onclick="return confirm('¿Estás seguro de eliminar esta factura?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No hay facturas registradas.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>