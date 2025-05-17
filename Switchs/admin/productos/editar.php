<?php
require_once '../../includes/config.php';
include '../templates/header.php';
include '../templates/sidebar.php';

$errores = [];
$mensaje = '';
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "<div class='alert alert-danger'>ID de producto no especificado.</div>";
    include '../templates/footer.php';
    exit;
}

// Obtener datos del producto
try {
    $stmt = $pdo->prepare("SELECT * FROM producto WHERE id_producto = :id");
    $stmt->execute([':id' => $id]);
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$producto) {
        echo "<div class='alert alert-danger'>Producto no encontrado.</div>";
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
    $descripcion = $_POST['descripcion'] ?? '';
    $precio = $_POST['precio'] ?? 0;
    $stock = $_POST['stock'] ?? 0;
    $id_categoria = $_POST['id_categoria'] ?? null;

    // Imagen
    $imagen_url = $producto['imagen_url'];
    if (!empty($_FILES['imagen']['name'])) {
        $target_dir = "../../assets/img/products/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        $nombre_archivo = basename($_FILES["imagen"]["name"]);
        $ruta_archivo = $target_dir . $nombre_archivo;
        $imagen_url = "assets/img/products/" . $nombre_archivo;

        if (!move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_archivo)) {
            $errores[] = "Error al subir la nueva imagen.";
        }
    }

    // Actualizar si no hay errores
    if (empty($errores)) {
        try {
            $sql = "UPDATE producto SET 
                        nombre = :nombre, 
                        descripcion = :descripcion, 
                        precio = :precio, 
                        stock = :stock, 
                        imagen_url = :imagen_url, 
                        id_categoria = :id_categoria
                    WHERE id_producto = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nombre' => $nombre,
                ':descripcion' => $descripcion,
                ':precio' => $precio,
                ':stock' => $stock,
                ':imagen_url' => $imagen_url,
                ':id_categoria' => $id_categoria,
                ':id' => $id
            ]);
            $mensaje = "Producto actualizado correctamente.";
            // Refrescar datos actualizados
            $producto = array_merge($producto, $_POST);
            $producto['imagen_url'] = $imagen_url;
        } catch (PDOException $e) {
            $errores[] = "Error al actualizar: " . $e->getMessage();
        }
    }
}
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Editar Producto</h1>

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

    <form action="" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label>Nombre:</label>
            <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($producto['nombre']) ?>" required>
        </div>

        <div class="form-group">
            <label>Descripción:</label>
            <textarea name="descripcion" class="form-control" required><?= htmlspecialchars($producto['descripcion']) ?></textarea>
        </div>

        <div class="form-group">
            <label>Precio (€):</label>
            <input type="number" step="0.01" name="precio" class="form-control" value="<?= $producto['precio'] ?>" required>
        </div>

        <div class="form-group">
            <label>Stock:</label>
            <input type="number" name="stock" class="form-control" value="<?= $producto['stock'] ?>" required>
        </div>

        <div class="form-group">
            <label>Imagen actual:</label><br>
            <?php if (!empty($producto['imagen_url'])): ?>
                <img src="../../<?= $producto['imagen_url'] ?>" alt="Imagen" width="100"><br><br>
            <?php endif; ?>
            <input type="file" name="imagen" class="form-control-file">
        </div>

        <div class="form-group">
            <label>ID Categoría:</label>
            <input type="number" name="id_categoria" class="form-control" value="<?= $producto['id_categoria'] ?>">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="listar.php" class="btn btn-secondary">Volver</a>
    </form>
</div>

<?php include '../templates/footer.php'; ?>