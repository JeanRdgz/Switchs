<?php
session_start();
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

        <section class="section-image">
            <div class="section-image-item">
                <div class="section-image-text">
                    <h2>Colaboraciones exclusivas y limitadas</h2>
                    <p>¡No te pierdas la oportunidad de conseguir artículos exclusivos y originales!</p>
                </div>
            </div>
        </section>

        <!-- Nueva sección tipo "local stock" -->
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

    </main>
    <?php include '../components/footer.php'; ?>
    <script src="../assets/js/slider.js"></script>
</body>

</html>