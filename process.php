<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Envía el formulario de registro para ver tus datos.');
}

$nombre = trim(is_string($_POST['nombre'] ?? null) ? $_POST['nombre'] : '');
$correo = trim(is_string($_POST['correo'] ?? null) ? $_POST['correo'] : '');
$mensaje = trim(is_string($_POST['mensaje'] ?? null) ? $_POST['mensaje'] : '');

if ($nombre === '' || !filter_var($correo, FILTER_VALIDATE_EMAIL) || $mensaje === '') {
    http_response_code(400);
    exit('Todos los campos deben ser llenados. El correo debe ir en un formato valido.');
}

$nombreSeguro = htmlspecialchars($nombre, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$correoSeguro = htmlspecialchars($correo, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$mensajeSeguro = htmlspecialchars($mensaje, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Datos de registro</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <main class="registro confirmacion">
    <h1>Registro recibido</h1>
    <p class="descripcion">Estos son los datos que enviaste:</p>

    <p><strong>Nombre completo:</strong> <?= $nombreSeguro ?></p>
    <p><strong>Correo electrónico:</strong> <?= $correoSeguro ?></p>
    <p><strong>Su Mensaje:</strong> <?=  $mensajeSeguro  ?></p>

    <a class="enlace" href="index.html">Volver al formulario</a>
  </main>
</body>
</html>