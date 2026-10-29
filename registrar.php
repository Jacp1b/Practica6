<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Envia el formulario de registro para continuar.');
}

$nombre = trim(is_string($_POST['nombre'] ?? null) ? $_POST['nombre'] : '');
$documento = trim(is_string($_POST['documento'] ?? null) ? $_POST['documento'] : '');
$correo = trim(is_string($_POST['correo'] ?? null) ? $_POST['correo'] : '');
$programa = trim(is_string($_POST['programa'] ?? null) ? $_POST['programa'] : '');
$jornada = trim(is_string($_POST['jornada'] ?? null) ? $_POST['jornada'] : '');

$programasValidos = [
    'Analisis y Desarrollo de Software',
    'Gestion Administrativa',
    'Contabilizacion de Operaciones Comerciales y Financieras',
];
$jornadasValidas = ['Mañana', 'Tarde', 'Noche'];

if (
    $nombre === '' || is_numeric($nombre)
    || $documento === ''
    || !filter_var($correo, FILTER_VALIDATE_EMAIL)
    || !in_array($programa, $programasValidos, true)
    || !in_array($jornada, $jornadasValidas, true)
) {
    http_response_code(400);
    exit('Completa todos los campos y verifica que el correo tenga un formato valido.');
}

$nombreSeguro = htmlspecialchars($nombre, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$documentoSeguro = htmlspecialchars($documento, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$correoSeguro = htmlspecialchars($correo, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$programaSeguro = htmlspecialchars($programa, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$jornadaSeguro = htmlspecialchars($jornada, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro recibido</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <main class="registro confirmacion">
    <h1>Registro recibido</h1>
    <p class="descripcion">Estos son los datos del aprendiz registrado:</p>

    <p><strong>Nombre completo:</strong> <?= $nombreSeguro ?></p>
    <p><strong>Documento de identidad:</strong> <?= $documentoSeguro ?></p>
    <p><strong>Correo electronico:</strong> <?= $correoSeguro ?></p>
    <p><strong>Programa de formacion:</strong> <?= $programaSeguro ?></p>
    <p><strong>Jornada:</strong> <?= $jornadaSeguro ?></p>

    <a class="enlace" href="index.html">Volver al formulario</a>
  </main>
</body>
</html>
