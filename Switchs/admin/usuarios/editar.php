<?php
require_once '../../includes/config.php';
include '../templates/header.php';
include '../templates/sidebar.php';

$errores = [];
$mensaje = '';
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "<div class='alert alert-danger'>ID de usuario no especificado.</div>";
    include '../templates/footer.php';
    exit;
}

// Obtener datos del usuario
try {
    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE id_usuario = :id");
    $stmt->execute([':id' => $id]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        echo "<div class='alert alert-danger'>Usuario no encontrado.</div>";
        include '../templates/footer.php';
        exit;
    }
} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    include '../templates/footer.php';
    exit;
}

// Si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $direccion_envio = $_POST['direccion_envio'] ?? '';
    $fecha_registro = $_POST['fecha_registro'] ?? '';

    // Validaciones simples
    if (empty($nombre)) $errores[] = "El nombre es obligatorio.";
    if (empty($correo)) $errores[] = "El correo es obligatorio.";
    if (empty($direccion_envio)) $errores[] = "La dirección de envío es obligatoria.";
    if (empty($fecha_registro)) $errores[] = "La fecha de registro es obligatoria.";

    if (empty($errores)) {
        try {
            $sql = "UPDATE usuario SET 
                        nombre = :nombre, 
                        correo = :correo, 
                        dirección_envío = :direccion_envio, 
                        fecha_registro = :fecha_registro
                    WHERE id_usuario = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nombre' => $nombre,
                ':correo' => $correo,
                ':direccion_envio' => $direccion_envio,
                ':fecha_registro' => $fecha_registro,
                ':id' => $id
            ]);
            $mensaje = "Usuario actualizado correctamente.";
            // Refrescar datos actualizados
            $usuario['nombre'] = $nombre;
            $usuario['correo'] = $correo;
            $usuario['dirección_envío'] = $direccion_envio;
            $usuario['fecha_registro'] = $fecha_registro;
        } catch (PDOException $e) {
            $errores[] = "Error al actualizar: " . $e->getMessage();
        }
    }
}
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Editar Usuario</h1>

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

    <form action="" method="POST">
        <div class="form-group">
            <label>Nombre:</label>
            <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
        </div>
        <div class="form-group">
            <label>Correo:</label>
            <input type="email" name="correo" class="form-control" value="<?= htmlspecialchars($usuario['correo']) ?>" required>
        </div>
        <div class="form-group">
            <label>Dirección de Envío:</label>
            <input type="text" name="direccion_envio" class="form-control" value="<?= htmlspecialchars($usuario['dirección_envío']) ?>" required>
        </div>
        <div class="form-group">
            <label>Fecha de Registro:</label>
            <input type="date" name="fecha_registro" class="form-control" value="<?= htmlspecialchars($usuario['fecha_registro']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="listar.php" class="btn btn-secondary">Volver</a>
    </form>
</div>

<?php include '../templates/footer.php'; ?>
