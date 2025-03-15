<?php
// Incluir el controlador PersonaController
require_once '../controlador/PersonaController.php';

// Crear una instancia del controlador
$personaController = new PersonaController();

// Obtener el código de la persona a eliminar
$codigo = $_GET['id'];

// Eliminar la persona
$resultado = $personaController->delete($codigo);
echo "<p>$resultado</p>";

// Redirigir a la lista de personas
header("Location: persona.php");
exit();
?>