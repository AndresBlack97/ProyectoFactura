<?php
// Incluir el controlador PersonaController
require_once '../controlador/PersonaController.php';

// Crear una instancia del controlador
$personaController = new PersonaController();

// Obtener el código de la persona a editar
$codigo = $_GET['id'];

// Obtener los datos de la persona
$persona = $personaController->readOne($codigo);

// Procesar el formulario de actualización
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];

    // Actualizar la persona
    $resultado = $personaController->update($codigo, $email, $nombre, $telefono);
    echo "<p>$resultado</p>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Persona</title>
</head>
<body>
    <h1>Editar Persona</h1>
    <form method="POST" action="">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $persona->email; ?>" required><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $persona->nombre; ?>" required><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" value="<?php echo $persona->telefono; ?>" required><br>

        <button type="submit">Actualizar Persona</button>
    </form>
    <a href="persona.php">Volver a la lista</a>
</body>
</html>