<?php
require_once '../../includes/config.php';
include '../templates/header.php';
include '../templates/sidebar.php';

try {
    $stmt = $pdo->query("SELECT * FROM usuario");
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al obtener usuarios: " . $e->getMessage());
}
?>
<style>
    h1 {
        margin-top: 20px;
    }
</style>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Gestión de Usuarios</h1>

    <a href="crear.php" class="btn btn-primary mb-3">Agregar nuevo usuario</a>

    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Dirección de Envío</th>
                <th>Fecha de Registro</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= htmlspecialchars($usuario['id_usuario']) ?></td>
                    <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                    <td><?= htmlspecialchars($usuario['correo']) ?></td>
                    <td><?= htmlspecialchars($usuario['dirección_envío']) ?></td>
                    <td><?= htmlspecialchars($usuario['fecha_registro']) ?></td>
                    <td>
                        <a href="editar.php?id=<?= $usuario['id_usuario'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="eliminar.php?id=<?= $usuario['id_usuario'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?php include '../templates/footer.php'; ?>