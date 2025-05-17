<?php
require_once '../../includes/config.php';
include '../templates/header.php';
include '../templates/sidebar.php';

try {
    $stmt = $pdo->query("SELECT * FROM producto");
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al obtener productos: " . $e->getMessage());
}
?>

<style>
    h1 {
        margin-top: 20px;
    }
</style>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Gestión de Productos</h1>

    <a href="crear.php" class="btn btn-primary mb-3">Agregar nuevo producto</a>

    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio (€)</th>
                <th>Stock</th>
                <th>Imagen</th>
                <th>ID Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?= htmlspecialchars($producto['id_producto']) ?></td>
                    <td><?= htmlspecialchars($producto['nombre']) ?></td>
                    <td><?= htmlspecialchars($producto['descripcion']) ?></td>
                    <td><?= number_format($producto['precio'], 2) ?></td>
                    <td><?= $producto['stock'] ?></td>
                    <td>
                        <?php if (!empty($producto['imagen_url'])): ?>
                            <img src="../../<?= htmlspecialchars($producto['imagen_url']) ?>" width="50" alt="Imagen">
                        <?php else: ?>
                            Sin imagen
                        <?php endif; ?>
                    </td>
                    <td><?= $producto['id_categoria'] ?></td>
                    <td>
                        <a href="editar.php?id=<?= $producto['id_producto'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="eliminar.php?id=<?= $producto['id_producto'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este producto?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?php include '../templates/footer.php'; ?>