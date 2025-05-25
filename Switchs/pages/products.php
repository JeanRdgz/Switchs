<?php
session_start();
require_once '../includes/config.php';

// Obtener categorías seleccionadas del filtro
$filtro_categorias = [];
if (isset($_GET['categorias']) && is_array($_GET['categorias'])) {
    $filtro_categorias = array_map('intval', $_GET['categorias']);
}

// Construir consulta SQL según filtro
try {
    if (!empty($filtro_categorias)) {
        $placeholders = implode(',', array_fill(0, count($filtro_categorias), '?'));
        $stmt = $pdo->prepare("SELECT * FROM Producto WHERE id_categoria IN ($placeholders)");
        $stmt->execute($filtro_categorias);
    } else {
        $stmt = $pdo->query("SELECT * FROM Producto");
    }
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

        <form id="filtro-categorias-form" class="filtro-categorias-form" method="get">
            <label style="font-weight:bold;">Filtrar por categoría:</label>
            <label><input type="checkbox" name="categorias[]" value="1" <?php if(in_array(1, $filtro_categorias)) echo 'checked'; ?>> Keyboards</label>
            <label><input type="checkbox" name="categorias[]" value="2" <?php if(in_array(2, $filtro_categorias)) echo 'checked'; ?>> DIY-kit</label>
            <label><input type="checkbox" name="categorias[]" value="3" <?php if(in_array(3, $filtro_categorias)) echo 'checked'; ?>> Switch</label>
            <label><input type="checkbox" name="categorias[]" value="4" <?php if(in_array(4, $filtro_categorias)) echo 'checked'; ?>> Keycap</label>
            <button type="submit">Filtrar</button>
            <?php if (!empty($filtro_categorias)): ?>
                <a href="products.php">Quitar filtros</a>
            <?php endif; ?>
        </form>

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
                            <div class="product-stars
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
                                <form class="add-to-cart-form" onsubmit="return false;">
                                    <input type="hidden" name="id_producto" value="<?= $producto['id_producto'] ?>">
                                    <input type="number" name="cantidad" min="1" max="<?= intval($producto['stock']) ?>" value="1">
                                    <button type="button" class="product-btn same-size-btn" onclick="agregarAlCarrito(this)">Agregar</button>
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
    <script>
        
    //funcion para agregar al carrito
    function agregarAlCarrito(btn) {
        const form = btn.closest('form');
        const id_producto = form.querySelector('input[name="id_producto"]').value;
        const cantidad = form.querySelector('input[name="cantidad"]').value;

        fetch('agregar_carrito.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: `id_producto=${encodeURIComponent(id_producto)}&cantidad=${encodeURIComponent(cantidad)}`
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert(data.message || 'Producto agregado al carrito');
            } else if (data.message && data.message.includes('iniciar sesión')) {
                window.location.href = 'login.php';
            } else {
                alert(data.message || 'Error al agregar al carrito');
            }
        })
        .catch(() => alert('Error de conexión con el servidor.'));
    }
    </script>
</body>

</html>