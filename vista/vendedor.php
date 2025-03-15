<?php
// Incluir el controlador VendedorController
require_once '../controlador/VendedorController.php';

// Crear una instancia del controlador
$vendedorController = new VendedorController();

// Mostrar mensajes de éxito o error
if (isset($_GET['mensaje'])) {
    echo "<p>" . htmlspecialchars($_GET['mensaje']) . "</p>";
}

// Procesar el formulario de creación de vendedor
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = $_POST['codigo'];
    $email = $_POST['email'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $carne = $_POST['carne'];
    $direccion = $_POST['direccion'];

    // Crear el vendedor
    $resultado = $vendedorController->create($codigo, $email, $nombre, $telefono, $carne, $direccion);
    echo "<p>$resultado</p>";
}

// Obtener la lista de vendedores
$vendedores = $vendedorController->readAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Vendedores</title>
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
    <h1>Gestión de Vendedores</h1>

    <!-- Formulario para crear un vendedor -->
    <h2>Crear Nuevo Vendedor</h2>
    <form method="POST" action="">
        <label for="codigo">Código:</label>
        <input type="text" id="codigo" name="codigo" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" required><br>

        <label for="carne">Carne:</label>
        <input type="number" id="carne" name="carne" required><br>

        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" required><br>

        <button type="submit">Crear Vendedor</button>
    </form>

    <!-- Lista de vendedores -->
    <h2>Lista de Vendedores</h2>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Email</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Carne</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($vendedores)): ?>
                <?php foreach ($vendedores as $vendedor): ?>
                    <tr>
                        <td><?php echo $vendedor->getCodigo(); ?></td>
                        <td><?php echo $vendedor->getEmail(); ?></td>
                        <td><?php echo $vendedor->getNombre(); ?></td>
                        <td><?php echo $vendedor->getTelefono(); ?></td>
                        <td><?php echo $vendedor->getCarne(); ?></td>
                        <td><?php echo $vendedor->getDireccion(); ?></td>
                        <td>
                            <a href="editar_vendedor.php?id=<?php echo $vendedor->getCodigo(); ?>">Editar</a>
                            <a href="eliminar_vendedor.php?id=<?php echo $vendedor->getCodigo(); ?>" onclick="return confirm('¿Estás seguro de eliminar este vendedor?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No hay vendedores registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>