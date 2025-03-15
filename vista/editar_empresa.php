<?php
// Incluir el controlador EmpresaController
require_once '../controlador/EmpresaController.php';

// Crear una instancia del controlador
$empresaController = new EmpresaController();

// Obtener el código de la empresa a editar
$codigo_empresa = $_GET['id'];

// Obtener los datos de la empresa
$empresa = $empresaController->readOne($codigo_empresa);

// Procesar el formulario de actualización
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];

    // Actualizar la empresa
    $resultado = $empresaController->update($codigo_empresa, $nombre);
    echo "<p>$resultado</p>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empresa</title>
</head>
<body>
    <h1>Editar Empresa</h1>
    <form method="POST" action="">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $empresa->nombre; ?>" required><br>

        <button type="submit">Actualizar Empresa</button>
    </form>
    <a href="empresa.php">Volver a la lista</a>
</body>
</html>