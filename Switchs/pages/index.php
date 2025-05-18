<?php
session_start();

// Newsletter handler (solo muestra mensaje de éxito, no envía correo)
$newsletter_success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newsletter_email'])) {
    $newsletter_success = true;
    $_SESSION['newsletter_success'] = true;
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Switch's</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <script src="https://kit.fontawesome.com/637af3b88f.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include '../components/header.php'; ?>
    <main>
        <div class="slider">
            <div class="slide">
                <img src="../assets/images/slider2.webp" alt="Slider 1">
                <div class="slide-overlay"></div>
            </div>
            <div class="slide">
                <img src="../assets/images/slider6.webp" alt="Slider 2">
                <div class="slide-overlay"></div>
            </div>
            <div class="slide">
                <img src="../assets/images/slider1.webp" alt="Slider 3">
                <div class="slide-overlay"></div>
            </div>
            <div class="slide">
                <img src="../assets/images/slider4.webp" alt="Slider 4">
                <div class="slide-overlay"></div>
            </div>
        </div>

        <!-- sección "local stock" -->
        <section class="section-local-stock">
            <div class="local-stock-img">
                <img src="../assets/images/slider5.webp" alt="Stock Local Switchs">
            </div>
            <div class="local-stock-info">
                <div class="fast">¡Entrega rápida en 2-3 días!</div>
                <h3>Stock Local</h3>
                <ul>
                    <li><b>2-3 días</b> de entrega rápida solo para clientes de España peninsular.</li>
                    <li><b>4-7 días</b> de envío para el resto de Europa.</li>
                </ul>
                <a href="#" class="discover-btn">Descubrir ahora</a>
            </div>
        </section>

        <!-- sección "local stock" con imagen a la derecha -->
        <section class="section-local-stock-alt">
            <div class="local-stock-img">
                <img src="../assets/images/imageIndex1.webp" alt="Stock Internacional Switchs">
            </div>
            <div class="local-stock-info">
                <div class="fast">¡Conoce un poco más!</div>
                <h3>Estructura</h3>
                <p>
                    Nuestros teclados están diseñados con una estructura premium y modular, pensada para ofrecer la mejor experiencia de escritura y personalización. Cada componente, desde las keycaps PBT double-shot hasta la base de silicona y las alturas ajustables, ha sido seleccionado para maximizar la durabilidad, el confort y el rendimiento. Disfruta de una construcción robusta, materiales de alta calidad y una estética cuidada en cada detalle.
                </p>
            </div>
        </section>

        <!--seccion de contacto-->
        <section class="section-contact">
            <div class="section-item">
                <i class="fa-solid fa-truck-fast"></i>
                <h3>Envío Rápido</h3>
                <p>Recibe tus productos en tiempo récord en toda España.</p>
            </div>
            <div class="section-item">
                <i class="fa-solid fa-shield-halved"></i>
                <h3>Compra Segura</h3>
                <p>Tus pagos y datos están protegidos con la mejor tecnología.</p>
            </div>
            <div class="section-item">
                <i class="fa-solid fa-headset"></i>
                <h3>Soporte 24/7</h3>
                <p>Atención personalizada para resolver todas tus dudas.</p>
            </div>
            <div class="section-item">
                <i class="fa-solid fa-rotate-left"></i>
                <h3>Devoluciones Fáciles</h3>
                <p>Política de devolución de 30 días sin complicaciones.</p>
            </div>
        </section>

        <!-- seccion "imagen parallax" -->
        <section class="section-image">
            <div class="section-image-item">
                <div class="section-image-text">
                    <h2>Colaboraciones exclusivas y limitadas</h2>
                    <p>¡No te pierdas la oportunidad de conseguir artículos exclusivos y originales!</p>
                </div>
            </div>
        </section>

        <!-- Newsletter Section con imagen -->
        <div class="newsletter-row">
            <section class="newsletter-section">
                <img src="../assets/images/logo.png" alt="Logo" class="newsletter-logo">
                <div class="newsletter-title">SUSCRÍBETE AL BOLETÍN INFORMATIVO</div>
                <div class="newsletter-desc">Suscríbete para recibir noticias y promociones.</div>
                <?php if (!empty($_SESSION['newsletter_success'])): ?>
                    <div style="color:green;margin-bottom:1rem;">¡Gracias por suscribirte! Revisa tu correo.</div>
                    <?php unset($_SESSION['newsletter_success']); ?>
                <?php endif; ?>
                <form class="newsletter-form" method="post" action="">
                    <input type="email" name="newsletter_email" placeholder="Correo electrónico" required>
                    <button type="submit"><i class="fa-solid fa-arrow-right"></i></button>
                </form>
                <div class="newsletter-social">
                    <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-youtube"></i></a>
                    <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                    <a href="#"><i class="fa-brands fa-discord"></i></a>
                </div>
            </section>
            <div class="newsletter-image-side">
                <img src="../assets/images/slider11.webp" alt="Newsletter Imagen">
            </div>
        </div>

        <!-- Carrusel Instagram -->
        <div class="instagram-carousel-container">
            <div class="instagram-carousel-title">
                Síguenos en Instagram <b>@switchs.eu</b>
            </div>
            <div class="instagram-carousel-wrapper">
                <button class="instagram-carousel-arrow left" id="insta-arrow-left">&#8249;</button>
                <div class="instagram-carousel" id="instagram-carousel">
                    <div class="instagram-carousel-image">
                        <img src="../assets/images/slider1.webp" alt="Instagram 1">
                    </div>
                    <div class="instagram-carousel-image">
                        <img src="../assets/images/slider4.webp" alt="Instagram 2">
                    </div>
                    <div class="instagram-carousel-image">
                        <img src="../assets/images/slider12.jpeg" alt="Instagram 3">
                    </div>
                    <div class="instagram-carousel-image">
                        <img src="../assets/images/slider8.webp" alt="Instagram 4">
                    </div>
                    <div class="instagram-carousel-image">
                        <img src="../assets/images/slider6.webp" alt="Instagram 5">
                    </div>
                    <div class="instagram-carousel-image">
                        <img src="../assets/images/slider9.avif" alt="Instagram 6">
                    </div>
                    <div class="instagram-carousel-image">
                        <img src="../assets/images/slider3.webp" alt="Instagram 7">
                    </div>
                    <div class="instagram-carousel-image">
                        <img src="../assets/images/bannerLogin.webp" alt="Instagram 8">
                    </div>
                </div>
                <button class="instagram-carousel-arrow right" id="insta-arrow-right">&#8250;</button>
            </div>
        </div>
    </main>
    <?php include '../components/footer.php'; ?>
    <script src="../assets/js/slider.js"></script>
    <script src="../assets/js/instagram-carousel.js"></script>
</body>

</html>