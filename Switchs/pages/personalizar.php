<?php
session_start();
require_once '../includes/config.php';

function obtenerProductosPorCategoria($categoriaId, $pdo)
{
    $stmt = $pdo->prepare("SELECT id_producto, nombre, imagen_url FROM Producto WHERE id_categoria = ?");
    $stmt->execute([$categoriaId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$kits = obtenerProductosPorCategoria(2, $pdo);
$switches = obtenerProductosPorCategoria(3, $pdo);
$keycaps = obtenerProductosPorCategoria(4, $pdo);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personaliza tu teclado</title>
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/personalizar.css">
    <script src="https://kit.fontawesome.com/637af3b88f.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include '../components/header.php'; ?>
    <main>
        <div class="slider">
            <div class="slide">
                <img src="../assets/images/bannerLogin.webp" alt="Slider 1">
                <div class="slide-overlay"></div>
            </div>
            <div class="slide">
                <img src="../assets/images/slider5.webp" alt="Slider 2">
                <div class="slide-overlay"></div>
            </div>
            <div class="slide">
                <img src="../assets/images/slider6.webp" alt="Slider 3">
                <div class="slide-overlay"></div>
            </div>
            <div class="slide">
                <img src="../assets/images/slider11.webp" alt="Slider 4">
                <div class="slide-overlay"></div>
            </div>
        </div>

        <div class="personalizar-container">
            <div class="personalizar-img-sticky">
                <img src="../assets/images/slider12.jpeg" alt="Personaliza tu teclado">
            </div>
            <div class="personalizar-content">
                <h1>Personaliza tu teclado</h1>
                <p>
                    Descubre todas las opciones para personalizar tu teclado: elige el color o diseño de las teclas, el tipo de switch (táctil, clicky, linear, silent), el case de CNC de aluminio en el cual podrás escoger el color y formato (100%, TKL, 75% Y 60%) Y mucho más. Crea un teclado único a tu medida.
                </p>
                <h2>Opciones disponibles</h2>
                <ul>
                    <li>Keycaps en varios colores, diseños y materiales</li>
                    <li>Switches mecánicos y magnéticos de tipo táctil, clicky, linear y silent</li>
                    <li>Retroiluminación RGB personalizable</li>
                    <li>Diseños exclusivos y colaboraciones</li>
                </ul>
                <h2>¿Por qué personalizar?</h2>
                <p>
                    Un teclado personalizado no solo mejora tu experiencia de uso, sino que también refleja tu estilo y personalidad. ¡Hazlo único!
                </p>
                <button class="personalizar-btn" id="personalizar-btn">Comenzar personalización</button>
            </div>
        </div>

        <section id="personalizar-dinamico-section">
            <div class="personalizar-dinamico-img">
                <img id="personalizar-dinamico-img" src="<?php echo !empty($kits) ? '../' . htmlspecialchars($kits[0]['imagen_url']) : '../assets/img/products/DIYKit1.webp'; ?>" alt="Vista teclado personalizado">
            </div>
            <div class="personalizar-dinamico-options">
                <div class="personalizar-dinamico-group">
                    <label>DIY-kit:</label>
                    <div class="personalizar-dinamico-buttons" id="color-options">
                        <?php foreach ($kits as $i => $kit): ?>
                            <button class="personalizar-dinamico-btn<?php echo $i === 0 ? ' active' : ''; ?>"
                                data-img="<?php echo '../' . htmlspecialchars($kit['imagen_url']); ?>"
                                data-id="<?php echo $kit['id_producto']; ?>">
                                <?php echo htmlspecialchars($kit['nombre']); ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="personalizar-dinamico-group">
                    <label>Switches:</label>
                    <div class="personalizar-dinamico-buttons" id="layout-options">
                        <?php foreach ($switches as $i => $switch): ?>
                            <button class="personalizar-dinamico-btn<?php echo $i === 0 ? ' active' : ''; ?>"
                                data-img="<?php echo '../' . htmlspecialchars($switch['imagen_url']); ?>"
                                data-id="<?php echo $switch['id_producto']; ?>">
                                <?php echo htmlspecialchars($switch['nombre']); ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="personalizar-dinamico-group">
                    <label>Keycaps:</label>
                    <div class="personalizar-dinamico-buttons" id="keycap-options">
                        <?php foreach ($keycaps as $i => $keycap): ?>
                            <button class="personalizar-dinamico-btn<?php echo $i === 0 ? ' active' : ''; ?>"
                                data-img="<?php echo '../' . htmlspecialchars($keycap['imagen_url']); ?>"
                                data-id="<?php echo $keycap['id_producto']; ?>">
                                <?php echo htmlspecialchars($keycap['nombre']); ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

        <div style="width:100%;display:flex;justify-content:center;margin:2.5rem 0;">
            <button id="add-to-cart-btn" class="personalizar-btn" style="min-width:220px;font-size:1.15rem;">
                Agregar al carrito
            </button>
        </div>
    </main>
    <?php include '../components/footer.php'; ?>
    <script src="../assets/js/slider.js"></script>
    <script>
        // Mostrar sección al hacer click en el botón
        document.getElementById('personalizar-btn').addEventListener('click', function() {
            document.getElementById('personalizar-dinamico-section').classList.add('active');
            document.getElementById('personalizar-dinamico-section').scrollIntoView({
                behavior: 'smooth'
            });
        });

        // Cambiar imagen al hacer click en los botones de opciones
        function setupPersonalizarOptions(groupId) {
            const group = document.getElementById(groupId);
            if (!group) return;
            group.addEventListener('click', function(e) {
                if (e.target.classList.contains('personalizar-dinamico-btn')) {
                    // Quitar active de todos
                    Array.from(group.children).forEach(btn => btn.classList.remove('active'));
                    e.target.classList.add('active');
                    // Cambiar imagen si tiene data-img
                    const imgSrc = e.target.getAttribute('data-img');
                    if (imgSrc) {
                        document.getElementById('personalizar-dinamico-img').src = imgSrc;
                    }
                }
            });
        }
        setupPersonalizarOptions('color-options');
        setupPersonalizarOptions('layout-options');
        setupPersonalizarOptions('keycap-options');

        //Agregar al carrito la personalizacion
        document.getElementById('add-to-cart-btn').addEventListener('click', function() {

            function getSelectedProductId(groupId) {
                const group = document.getElementById(groupId);
                const activeBtn = group.querySelector('.personalizar-dinamico-btn.active');
                return activeBtn ? activeBtn.getAttribute('data-id') : null;
            }
            const kitId = getSelectedProductId('color-options');
            const switchId = getSelectedProductId('layout-options');
            const keycapId = getSelectedProductId('keycap-options');

            fetch('../pages/agregar_carrito.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `id_kit=${encodeURIComponent(kitId)}&id_switch=${encodeURIComponent(switchId)}&id_keycap=${encodeURIComponent(keycapId)}`
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message || 'Productos agregados al carrito');
                    } else if (data.message && data.message.includes('iniciar sesión')) {
                        window.location.href = '/Switchs/Switchs/pages/login.php';
                    } else {
                        alert(data.message || 'Error al agregar al carrito');
                    }
                })
                .catch(() => alert('Error de conexión con el servidor.'));
        });
    </script>
</body>

</html>