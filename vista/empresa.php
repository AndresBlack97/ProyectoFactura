<?php
// Incluir el controlador EmpresaController
require_once '../controlador/empresacontroller.php';

// Crear una instancia del controlador
$empresaController = new EmpresaController();

// Procesar el formulario de creación de empresa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo_empresa = $_POST['codigo_empresa'];
    $nombre = $_POST['nombre'];

    // Crear la empresa
    $resultado = $empresaController->create($codigo_empresa, $nombre);
    echo "<p>$resultado</p>";
}

// Obtener la lista de empresas
$empresas = $empresaController->readAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Empresas</title>
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
    <h1>Gestión de Empresas</h1>

    <!-- Formulario para crear una empresa -->
    <h2>Crear Nueva Empresa</h2>
    <form method="POST" action="">
        <label for="codigo_empresa">Código:</label>
        <input type="text" id="codigo_empresa" name="codigo_empresa" required><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>

        <button type="submit">Crear Empresa</button>
    </form>

    <!-- Lista de empresas -->
    <h2>Lista de Empresas</h2>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($empresas)): ?>
                <?php foreach ($empresas as $empresa): ?>
                    <tr>
                        <td><?php echo $empresa->codigo_empresa; ?></td>
                        <td><?php echo $empresa->nombre; ?></td>
                        <td>
                            <a href="editar_empresa.php?id=<?php echo $empresa->codigo_empresa; ?>">Editar</a>
                            <a href="eliminar_empresa.php?id=<?php echo $empresa->codigo_empresa; ?>" onclick="return confirm('¿Estás seguro de eliminar esta empresa?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No hay empresas registradas.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>