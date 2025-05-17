<?php
require_once '../../includes/config.php';
include '../templates/header.php';
include '../templates/sidebar.php';

$errores = [];
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';

    if (empty($nombre)) $errores[] = "El nombre es obligatorio.";
    if (empty($descripcion)) $errores[] = "La descripción es obligatoria.";

    if (empty($errores)) {
        try {
            $sql = "INSERT INTO categoria (nombre, descripcion) VALUES (:nombre, :descripcion)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nombre' => $nombre,
                ':descripcion' => $descripcion
            ]);
            $mensaje = "Categoría agregada correctamente.";
        } catch (PDOException $e) {
            $errores[] = "Error al guardar: " . $e->getMessage();
        }
    }
}
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Agregar Categoría</h1>

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
            <label>Descripción:</label>
            <textarea name="descripcion" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Guardar Categoría</button>
        <a href="listar.php" class="btn btn-secondary">Volver</a>
    </form>
</div>

<?php include '../templates/footer.php'; ?>
