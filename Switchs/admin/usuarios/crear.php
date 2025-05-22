<?php
require_once '../../includes/config.php';
include '../templates/header.php';
include '../templates/sidebar.php';

$errores = [];
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $direccion_envio = $_POST['direccion_envio'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';

    // Validaciones simples
    if (empty($nombre)) $errores[] = "El nombre es obligatorio.";
    if (empty($correo)) $errores[] = "El correo es obligatorio.";
    if (empty($direccion_envio)) $errores[] = "La dirección de envío es obligatoria.";
    if (empty($contrasena)) $errores[] = "La contraseña es obligatoria.";

    if (empty($errores)) {
        try {
            $sql = "INSERT INTO Usuario (nombre, correo, direccion_envio, contraseña)
                    VALUES (:nombre, :correo, :direccion_envio, :contrasena)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nombre' => $nombre,
                ':correo' => $correo,
                ':direccion_envio' => $direccion_envio,
                ':contrasena' => password_hash($contrasena, PASSWORD_DEFAULT)
            ]);
            $mensaje = "Usuario agregado correctamente.";
        } catch (PDOException $e) {
            $errores[] = "Error al guardar: " . $e->getMessage();
        }
    }
}
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Agregar Usuario</h1>

    <?php if (!empty($mensaje)): ?>
        <div class="alert alert-success"><?= $mensaje ?></div>
    <?php endif; ?>

    <?php if (!empty($errores)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errores as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="" method="POST" class="mb-4">
        <div class="form-group">
            <label>Nombre:</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Correo:</label>
            <input type="email" name="correo" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Dirección:</label>
            <input type="text" name="direccion_envio" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Contraseña:</label>
            <input type="password" name="contrasena" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar Usuario</button>
        <a href="listar.php" class="btn btn-secondary">Volver</a>
    </form>
</div>

<?php include '../templates/footer.php'; ?>