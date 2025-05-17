<?php
require_once '../../includes/config.php';
include '../templates/header.php';
include '../templates/sidebar.php';

$id_pedido = $_GET['id'] ?? null;

if (!$id_pedido) {
    echo "<div class='alert alert-danger'>ID de pedido no especificado.</div>";
    include '../templates/footer.php';
    exit;
}

// Obtener información del pedido
try {
    $stmtPedido = $pdo->prepare("SELECT * FROM pedido WHERE id_pedido = :id_pedido");
    $stmtPedido->execute([':id_pedido' => $id_pedido]);
    $pedido = $stmtPedido->fetch(PDO::FETCH_ASSOC);

    if (!$pedido) {
        echo "<div class='alert alert-danger'>Pedido no encontrado.</div>";
        include '../templates/footer.php';
        exit;
    }

    // Obtener nombre del usuario
    $nombre_usuario = '';
    if (!empty($pedido['id_usuario'])) {
        $stmtUsuario = $pdo->prepare("SELECT nombre FROM usuario WHERE id_usuario = :id_usuario");
        $stmtUsuario->execute([':id_usuario' => $pedido['id_usuario']]);
        $usuario = $stmtUsuario->fetch(PDO::FETCH_ASSOC);
        $nombre_usuario = $usuario ? $usuario['nombre'] : 'Usuario no encontrado';
    }

    // Obtener detalles del pedido
    $stmtDetalles = $pdo->prepare(
        "SELECT dp.*, p.nombre AS producto_nombre 
         FROM detalle_pedido dp
         LEFT JOIN producto p ON dp.id_producto = p.id_producto
         WHERE dp.id_pedido = :id_pedido"
    );
    $stmtDetalles->execute([':id_pedido' => $id_pedido]);
    $detalles = $stmtDetalles->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    include '../templates/footer.php';
    exit;
}
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Detalle del Pedido #<?= htmlspecialchars($pedido['id_pedido']) ?></h1>
    <div class="mb-3">
        <strong>Estado:</strong> <?= htmlspecialchars($pedido['estado']) ?><br>
        <strong>Fecha:</strong> <?= htmlspecialchars($pedido['fecha_pedido']) ?><br>
        <strong>ID Usuario:</strong> <?= htmlspecialchars($pedido['id_usuario']) ?><br>
        <strong>Nombre Usuario:</strong> <?= htmlspecialchars($nombre_usuario) ?>
    </div>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario (€)</th>
                <th>Subtotal (€)</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $total = 0;
            foreach ($detalles as $detalle): 
                $subtotal = $detalle['precio_unitario'] * $detalle['cantidad'];
                $total += $subtotal;
            ?>
                <tr>
                    <td><?= htmlspecialchars($detalle['producto_nombre'] ?? 'Producto eliminado') ?></td>
                    <td><?= htmlspecialchars($detalle['cantidad']) ?></td>
                    <td><?= number_format($detalle['precio_unitario'], 2) ?></td>
                    <td><?= number_format($subtotal, 2) ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-right">Total:</th>
                <th><?= number_format($total, 2) ?> €</th>
            </tr>
        </tfoot>
    </table>
    <a href="listar.php" class="btn btn-secondary">Volver</a>
</div>

<?php include '../templates/footer.php'; ?>
