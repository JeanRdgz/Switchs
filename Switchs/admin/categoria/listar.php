<?php
require_once '../../includes/config.php';
include '../templates/header.php';
include '../templates/sidebar.php';

try {
    $stmt = $pdo->query("SELECT * FROM Categoria");
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al obtener categorías: " . $e->getMessage());
}
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Gestión de Categorías</h1>

    <a href="crear.php" class="btn btn-primary mb-3">Agregar nueva categoría</a>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorias as $categoria): ?>
                <tr>
                    <td><?= htmlspecialchars($categoria['id_categoria']) ?></td>
                    <td><?= htmlspecialchars($categoria['nombre']) ?></td>
                    <td><?= htmlspecialchars($categoria['descripcion']) ?></td>
                    <td>
                        <a href="editar.php?id=<?= $categoria['id_categoria'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="eliminar.php?id=<?= $categoria['id_categoria'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar esta categoría?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?php include '../templates/footer.php'; ?>
