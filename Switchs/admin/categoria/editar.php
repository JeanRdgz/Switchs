<?php
require_once '../../includes/config.php';
include '../templates/header.php';
include '../templates/sidebar.php';

$errores = [];
$mensaje = '';
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "<div class='alert alert-danger'>ID de categoría no especificado.</div>";
    include '../templates/footer.php';
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM categoria WHERE id_categoria = :id");
    $stmt->execute([':id' => $id]);
    $categoria = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$categoria) {
        echo "<div class='alert alert-danger'>Categoría no encontrada.</div>";
        include '../templates/footer.php';
        exit;
    }
} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    include '../templates/footer.php';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';

    if (empty($nombre)) $errores[] = "El nombre es obligatorio.";
    if (empty($descripcion)) $errores[] = "La descripción es obligatoria.";

    if (empty($errores)) {
        try {
            $sql = "UPDATE categoria SET nombre = :nombre, descripcion = :descripcion WHERE id_categoria = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nombre' => $nombre,
                ':descripcion' => $descripcion,
                ':id' => $id
            ]);
            $mensaje = "Categoría actualizada correctamente.";
            $categoria['nombre'] = $nombre;
            $categoria['descripcion'] = $descripcion;
        } catch (PDOException $e) {
            $errores[] = "Error al actualizar: " . $e->getMessage();
        }
    }
}
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Editar Categoría</h1>

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
            <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($categoria['nombre']) ?>" required>
        </div>
        <div class="form-group">
            <label>Descripción:</label>
            <textarea name="descripcion" class="form-control" required><?= htmlspecialchars($categoria['descripcion']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="listar.php" class="btn btn-secondary">Volver</a>
    </form>
</div>

<?php include '../templates/footer.php'; ?>
