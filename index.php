<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear cuenta</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <main class="registro">
    <h1>Crear cuenta</h1>
    <p class="descripcion">Completa tus datos para registrarte.</p>

    <form action="" method="post">
      <div class="campo">
        <label for="nombre">Nombre completo</label>
        <input type="text" id="nombre" name="nombre" autocomplete="name" required>
      </div>

      <div class="campo">
        <label for="correo">Correo electronico</label>
        <input type="email" id="correo" name="correo" autocomplete="email" required>
      </div>

      <div class="campo">
        <label for="contrasena">Contraseña</label>
        <input type="password" id="contrasena" name="contrasena" autocomplete="new-password" minlength="8" required>
      </div>

      <button type="submit">Registrarme</button>
    </form>
  </main>
</body>
</html>


<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Envía el formulario de registro para ver tus datos.');
}

$nombre = trim(is_string($_POST['nombre'] ?? null) ? $_POST['nombre'] : '');
$correo = trim(is_string($_POST['correo'] ?? null) ? $_POST['correo'] : '');

if ($nombre === '' || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    exit('Revisa el nombre y el correo electrónico e inténtalo de nuevo.');
}

$nombreSeguro = htmlspecialchars($nombre, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$correoSeguro = htmlspecialchars($correo, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
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
  <main class="registro">
    <h1>Registro recibido</h1>
    <p class="descripcion">Estos son los datos que enviaste:</p>

    <p><strong>Nombre completo:</strong> <?= $nombreSeguro ?></p>
    <p><strong>Correo electrónico:</strong> <?= $correoSeguro ?></p>
    <p>La contraseña no se muestra por seguridad.</p>

    <a href="index.html">Volver al formulario</a>
  </main>
</body>
</html>