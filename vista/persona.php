<?php
// Incluir el controlador PersonaController
require_once '../controlador/PersonaController.php';

// Crear una instancia del controlador
$personaController = new PersonaController();

// Procesar el formulario de creación de persona
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = $_POST['codigo'];
    $email = $_POST['email'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];

    // Crear la persona
    $resultado = $personaController->create($codigo, $email, $nombre, $telefono);
    echo "<p>$resultado</p>";
}

// Obtener la lista de personas
$personas = $personaController->readAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Personas</title>
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
    <h1>Gestión de Personas</h1>

    <!-- Formulario para crear una persona -->
    <h2>Crear Nueva Persona</h2>
    <form method="POST" action="">
        <label for="codigo">Código:</label>
        <input type="text" id="codigo" name="codigo" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" required><br>

        <button type="submit">Crear Persona</button>
    </form>

    <!-- Lista de personas -->
    <h2>Lista de Personas</h2>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Email</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($personas)): ?>
                <?php foreach ($personas as $persona): ?>
                    <tr>
                        <td><?php echo $persona->codigo; ?></td>
                        <td><?php echo $persona->email; ?></td>
                        <td><?php echo $persona->nombre; ?></td>
                        <td><?php echo $persona->telefono; ?></td>
                        <td>
                            <a href="editar_persona.php?id=<?php echo $persona->codigo; ?>">Editar</a>
                            <a href="eliminar_persona.php?id=<?php echo $persona->codigo; ?>" onclick="return confirm('¿Estás seguro de eliminar esta persona?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No hay personas registradas.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>