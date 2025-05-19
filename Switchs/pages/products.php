<?php
session_start();
require_once '../includes/config.php';

// Lógica para agregar al carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }
    $id_usuario = $_SESSION['user_id'];
    $id_producto = intval($_POST['product_id']);
    $cantidad = max(1, intval($_POST['cantidad']));

    // Buscar o crear carrito del usuario
    $stmt = $pdo->prepare("SELECT id_carrito FROM carrito WHERE id_usuario = ?");
    $stmt->execute([$id_usuario]);
    $carrito = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($carrito) {
        $id_carrito = $carrito['id_carrito'];
    } else {
        $pdo->prepare("INSERT INTO carrito (id_usuario) VALUES (?)")->execute([$id_usuario]);
        $id_carrito = $pdo->lastInsertId();
    }

    // Verificar si el producto ya está en el carrito
    $stmt = $pdo->prepare("SELECT cantidad FROM carrito_producto WHERE id_carrito = ? AND id_producto = ?");
    $stmt->execute([$id_carrito, $id_producto]);
    $carrito_producto = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($carrito_producto) {
        // Actualizar cantidad sumando la seleccionada
        $nueva_cantidad = $carrito_producto['cantidad'] + $cantidad;
        $pdo->prepare("UPDATE carrito_producto SET cantidad = ? WHERE id_carrito = ? AND id_producto = ?")
            ->execute([$nueva_cantidad, $id_carrito, $id_producto]);
    } else {
        // Insertar nuevo producto en el carrito con la cantidad seleccionada
        $pdo->prepare("INSERT INTO carrito_producto (id_carrito, id_producto, cantidad) VALUES (?, ?, ?)")
            ->execute([$id_carrito, $id_producto, $cantidad]);
    }
    $carrito_msg = "Producto agregado al carrito.";
}

// Obtener productos de la base de datos
try {
    $stmt = $pdo->query("SELECT * FROM producto");
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $productos = [];
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/products.css">
    <script src="https://kit.fontawesome.com/637af3b88f.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include '../components/header.php'; ?>
    <main>
        <div class="slider">
            <div class="slide">
                <img src="../assets/images/slider5.webp" alt="Slider 1">
                <div class="slide-overlay"></div>
            </div>
            <div class="slide">
                <img src="../assets/images/slider1.webp" alt="Slider 2">
                <div class="slide-overlay"></div>
            </div>
            <div class="slide">
                <img src="../assets/images/slider3.webp" alt="Slider 3">
                <div class="slide-overlay"></div>
            </div>
            <div class="slide">
                <img src="../assets/images/slider4.webp" alt="Slider 4">
                <div class="slide-overlay"></div>
            </div>
        </div>

        <?php if (!empty($carrito_msg)): ?>
            <div style="max-width:1200px;margin:1rem auto;color:green;text-align:center;font-weight:bold;">
                <?= htmlspecialchars($carrito_msg) ?>
            </div>
        <?php endif; ?>

        <section class="products-section">
            <div class="products-container">
                <?php foreach ($productos as $producto): ?>
                    <div class="product-card">
                        <div class="product-image">
                            <?php if (!empty($producto['imagen_url'])): ?>
                                <img src="../<?= htmlspecialchars($producto['imagen_url']) ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>">
                            <?php else: ?>
                                <img src="../assets/images/no-image.png" alt="Sin imagen">
                            <?php endif; ?>
                        </div>
                        <div class="product-info">
                            <div class="product-title"><?= htmlspecialchars($producto['nombre']) ?></div>
                            <div class="product-stars">
                                <i class="fa-solid fa-star" style="color: var(--primary);"></i>
                                <i class="fa-solid fa-star" style="color: var(--primary);"></i>
                                <i class="fa-solid fa-star" style="color: var(--primary);"></i>
                                <i class="fa-solid fa-star" style="color: var(--primary);"></i>
                                <i class="fa-solid fa-star" style="color: var(--primary);"></i>
                            </div>
                            <div class="product-price">
                                €<?= number_format($producto['precio'], 2) ?>
                            </div>
                            <div class="product-actions">
                                <form method="post">
                                    <input type="hidden" name="product_id" value="<?= $producto['id_producto'] ?>">
                                    <input type="number" name="cantidad" min="1" max="<?= intval($producto['stock']) ?>" value="1">
                                    <button type="submit" name="add_to_cart" class="product-btn same-size-btn">Agregar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
    <?php include '../components/footer.php'; ?>
    <script src="../assets/js/slider.js"></script>
</body>

</html>