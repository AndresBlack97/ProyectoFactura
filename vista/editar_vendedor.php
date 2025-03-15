<?php
// Incluir el controlador VendedorController
require_once '../controlador/VendedorController.php';

// Crear una instancia del controlador
$vendedorController = new VendedorController();

// Verificar si se ha enviado el formulario de actualización
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = $_POST['codigo'];
    $email = $_POST['email'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $carne = $_POST['carne'];
    $direccion = $_POST['direccion'];

    // Actualizar el vendedor
    $resultado = $vendedorController->update($codigo, $email, $nombre, $telefono, $carne, $direccion);
    echo "<p>$resultado</p>";
}

// Obtener el código del vendedor desde la URL
$codigo = $_GET['id'];

// Obtener la información del vendedor
$vendedor = $vendedorController->readOne($codigo);

// Verificar si el vendedor existe
if (!$vendedor) {
    echo "<p>Vendedor no encontrado.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Vendedor</title>
    <style>
        form {
            max-width: 400px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }
        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Editar Vendedor</h1>
    <form method="POST" action="">
        <!-- Campo oculto para el código del vendedor -->
        <input type="hidden" name="codigo" value="<?php echo $vendedor->getCodigo(); ?>">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $vendedor->getEmail(); ?>" required><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $vendedor->getNombre(); ?>" required><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" value="<?php echo $vendedor->getTelefono(); ?>" required><br>

        <label for="carne">Carne:</label>
        <input type="number" id="carne" name="carne" value="<?php echo $vendedor->getCarne(); ?>" required><br>

        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" value="<?php echo $vendedor->getDireccion(); ?>" required><br>

        <button type="submit">Actualizar Vendedor</button>
    </form>
    <br>
    <a href="vendedor.php">Volver a la lista de vendedores</a>
</body>
</html>