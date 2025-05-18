<?php
session_start();
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
                <img src="../assets/images/personalizarImage1.webp" alt="Personaliza tu teclado">
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

        <!-- Sección dinámica de personalización -->
        <section id="personalizar-dinamico-section">
            <div class="personalizar-dinamico-img">
                <img id="personalizar-dinamico-img" src="../assets/images/DIYKit1.webp" alt="Vista teclado personalizado">
            </div>
            <div class="personalizar-dinamico-options">
                <div class="personalizar-dinamico-group">
                    <label>DIY-kit:</label>
                    <div class="personalizar-dinamico-buttons" id="color-options">
                        <button class="personalizar-dinamico-btn active" data-img="../assets/images/DIYKit1.webp">Dark Night</button>
                        <button class="personalizar-dinamico-btn" data-img="../assets/images/DIYKit2.webp">Moonlight White</button>
                        <button class="personalizar-dinamico-btn" data-img="../assets/images/DIYKit3.webp">Purple</button>
                    </div>
                </div>
                <div class="personalizar-dinamico-group">
                    <label>Switches:</label>
                    <div class="personalizar-dinamico-buttons" id="layout-options">
                        <button class="personalizar-dinamico-btn active" data-img="../assets/images/switch8.webp">V3 Piano Pro - Clicky</button>
                        <button class="personalizar-dinamico-btn" data-img="../assets/images/switch9.webp">Rosewood - Linear</button>
                        <button class="personalizar-dinamico-btn" data-img="../assets/images/switch10.webp">Botany - Tactile</button>
                    </div>
                </div>
                <div class="personalizar-dinamico-group">
                    <label>Keycaps:</label>
                    <div class="personalizar-dinamico-buttons" id="layout-options">
                        <button class="personalizar-dinamico-btn active" data-img="../assets/images/switch8.webp">V3 Piano Pro - Clicky</button>
                        <button class="personalizar-dinamico-btn" data-img="../assets/images/switch9.webp">Rosewood - Linear</button>
                        <button class="personalizar-dinamico-btn" data-img="../assets/images/switch10.webp">Botany - Tactile</button>
                    </div>
                </div>
            </div>
        </section>
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
    </script>
</body>

</html>