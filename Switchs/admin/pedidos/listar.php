<?php
require_once '../../includes/config.php';
include '../templates/header.php';
include '../templates/sidebar.php';

try {
    // Obtener todos los pedidos
    $stmt = $pdo->query("SELECT * FROM pedido");
    $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Calcular el total real de cada pedido sumando los detalles
    $totales = [];
    foreach ($pedidos as $pedido) {
        $stmtDetalle = $pdo->prepare("SELECT SUM(precio_unitario * cantidad) as total FROM detalle_pedido WHERE id_pedido = :id_pedido");
        $stmtDetalle->execute([':id_pedido' => $pedido['id_pedido']]);
        $row = $stmtDetalle->fetch(PDO::FETCH_ASSOC);
        $totales[$pedido['id_pedido']] = $row['total'] ?? 0;
    }
} catch (PDOException $e) {
    die("Error al obtener pedidos: " . $e->getMessage());
}
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Gestión de Pedidos</h1>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID Pedido</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Fecha Pedido</th>
                <th>ID Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pedidos as $pedido): ?>
                <tr>
                    <td><?= htmlspecialchars($pedido['id_pedido']) ?></td>
                    <td><?= number_format($totales[$pedido['id_pedido']], 2) ?></td>
                    <td><?= htmlspecialchars($pedido['estado']) ?></td>
                    <td><?= htmlspecialchars($pedido['fecha_pedido']) ?></td>
                    <td><?= htmlspecialchars($pedido['id_usuario']) ?></td>
                    <td>
                        <a href="detallePedido.php?id=<?= $pedido['id_pedido'] ?>" class="btn btn-sm btn-primary">Detalle</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?php include '../templates/footer.php'; ?>
