<?php
session_start();
require_once '../includes/config.php';

$id_usuario = $_SESSION['id_usuario'] ?? null;
if (!$id_usuario) {
    header("Location: login.php");
    exit;
}

// Obtener el carrito del usuario
$stmt = $pdo->prepare("SELECT id_carrito FROM Carrito WHERE id_usuario = ?");
$stmt->execute([$id_usuario]);
$carrito = $stmt->fetch(PDO::FETCH_ASSOC);

$productos_carrito = [];
if ($carrito) {
    $id_carrito = $carrito['id_carrito'];
    $stmt = $pdo->prepare(
        "SELECT cp.*, p.nombre, p.precio, p.imagen_url
         FROM Carrito_producto cp
         JOIN Producto p ON cp.id_producto = p.id_producto
         WHERE cp.id_carrito = ?"
    );
    $stmt->execute([$id_carrito]);
    $productos_carrito = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mi Carrito</title>
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/products.css">
    <link rel="stylesheet" href="../assets/css/carrito.css">
</head>

<body>
    <?php include '../components/header.php'; ?>
    <main>
        <div class="carrito-bg-slider"></div>
        <?php if (empty($productos_carrito)): ?>
            <div style="text-align:center;margin:2rem 0;">Tu carrito está vacío.</div>
        <?php else: ?>
            <table class="carrito-table">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    <?php foreach ($productos_carrito as $item): ?>
                        <?php $subtotal = $item['precio'] * $item['cantidad'];
                        $total += $subtotal; ?>
                        <tr>
                            <td>
                                <?php if (!empty($item['imagen_url'])): ?>
                                    <img src="../<?= htmlspecialchars($item['imagen_url']) ?>" class="carrito-img" alt="<?= htmlspecialchars($item['nombre']) ?>">
                                <?php else: ?>
                                    <img src="../assets/images/no-image.png" class="carrito-img" alt="Sin imagen">
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($item['nombre']) ?></td>
                            <td>€<?= number_format($item['precio'], 2) ?></td>
                            <td><?= $item['cantidad'] ?></td>
                            <td>€<?= number_format($subtotal, 2) ?></td>
                            <td>
                                <form method="post" action="eliminar_carrito.php" style="display:inline;">
                                    <input type="hidden" name="id_producto" value="<?= $item['id_producto'] ?>">
                                    <button type="submit" class="btn-eliminar" title="Eliminar producto">&#10006;</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="carrito-total" style="max-width:900px;margin:0 auto;">
                Total: €<?= number_format($total, 2) ?>
            </div>
        <?php endif; ?>
    </main>
    <?php include '../components/footer.php'; ?>
</body>

</html>