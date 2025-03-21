<?php
require_once "utilidades.php";

$mensajeError = "";
$mensajeSuccesful = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreUsuario = $_POST['usuario'];
    $contrasenaUsuario = $_POST['contrasena'];
    $accion = $_POST['accion'];
    $usuarios = leerJSON("datos/usuarios.json");

    foreach ($usuarios as $usuario) {
        if ($accion === 'ingresar' && $usuario['nombreUsuario'] === $nombreUsuario && $usuario['contrasena'] === $contrasenaUsuario) {
            header("Location: productos.php?usuario=" . urlencode($nombreUsuario));
            exit;
        }
        if ($accion === 'registrar' && $usuario['nombreUsuario'] === $nombreUsuario) {
            $mensajeError = "Error: El usuario ya existe";
            break;
        }
    }

    if ($accion === 'registrar' && $mensajeError === "") {
        $usuarios[] = ["nombreUsuario" => $nombreUsuario, "contrasena" => $contrasenaUsuario, "carrito" => []];
        escribirJSON("datos/usuarios.json", $usuarios);
        $mensajeSuccesful = "Usuario registrado exitosamente";
    } else if ($accion === 'ingresar') {
        $mensajeError = "Error: Usuario o contraseña incorrectos";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="centrar">
    <form method="POST" action="inicio.php">
        <label for="usuario">Nombre de usuario:</label>
        <input type="text" id="usuario" name="usuario" required>
        <br><br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required>
        <br><br>
        <button type="submit" name="accion" value="ingresar">Ingresar</button>
        <button type="submit" name="accion" value="registrar">Darse de alta</button>
    </form>
    <?php if ($mensajeError): ?>
        <p class="error-message"><?php echo htmlspecialchars($mensajeError); ?></p>
    <?php endif; ?>
    <?php if ($mensajeSuccesful): ?>
        <p class="success-message"><?php echo htmlspecialchars($mensajeSuccesful); ?></p>
    <?php endif; ?>
</body>
</html>
