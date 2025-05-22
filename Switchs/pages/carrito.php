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
    <style>
        body {
            background: #fff;
        }
        .carrito-bg-slider {
            width: 100%;
            min-height: 220px;
            height: 32vh;
            max-height: 320px;
            background-image: linear-gradient(to right, rgba(0,0,0,0.55) 0%, rgba(0,0,0,0.15) 100%), url('../assets/images/slider5.webp');
            background-size: 30vw 100%;
            background-repeat: no-repeat;
            background-position: left top;
            display: block;
        }
        .carrito-table { width: 100%; max-width: 900px; margin: 2rem auto; background: #fff; border-radius: 12px; }
        .carrito-table th, .carrito-table td { padding: 12px 8px; text-align: center; }
        .carrito-table th { background: #f3f3f3; }
        .carrito-img { width: 60px; height: 60px; object-fit: contain; border-radius: 8px; }
        .carrito-total { font-size: 1.2rem; font-weight: bold; text-align: right; margin: 1.5rem 0 2rem 0; }
    </style>
</head>
<body>
<?php include '../components/header.php'; ?>
<main>
    <div class="carrito-bg-slider"></div>
    <h1 style="text-align:center;margin-top:2rem;">Mi Carrito</h1>
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
                    <?php $subtotal = $item['precio'] * $item['cantidad']; $total += $subtotal; ?>
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
