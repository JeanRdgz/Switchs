<?php
session_start();

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: keycaps.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Switch's Keyboards</title>
    <style>
        @import url(keycaps.css);
    </style>
    <script src="https://kit.fontawesome.com/637af3b88f.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <div class="container-hero">
            <div class="container hero">
                <div class="logo">
                    <a href="index.php">
                        <img src="imagenes/logo-switch's-horizontal.png" width="250px">
                    </a>
                </div>
                <div class="customer">
                    <i class="fa-solid fa-user" style="font-size: 30px;"></i>
                    <?php if (isset($_SESSION['usuario'])): ?>
                        <a href="cart.php" style="margin-left: 5px; color: white; text-decoration: none;">
                            <i class="fa-solid fa-cart-shopping" style="font-size: 30px;"></i>
                        </a>
                    <?php endif; ?>
                    <div class="user">
                        <span><?php echo isset($_SESSION['usuario']) ? "¡Bienvenido, " . htmlspecialchars($_SESSION['usuario']) . "!" : "¡Bienvenido!"; ?></span>
                        <?php if (isset($_SESSION['usuario'])): ?>
                            <a href="?logout=true" style="margin-left: 20px; background: transparent; border: 1px solid white; color: white; padding: 5px 10px; text-decoration: none; border-radius: 5px;">Cerrar sesión</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <nav class="container-navbar">
            <div class="container navbar">
                <ul class="menu">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="keyboards.php">Keyboards</a></li>
                    <li><a href="keycaps.php">Keycaps</a></li>
                    <li><a href="switches.php">Switches</a></li>
                    <li><a href="personalizar.php">Personalizar</a></li>
                    <?php if (!isset($_SESSION['usuario'])): ?>
                        <li><a href="usuario.php">Usuario</a></li>
                    <?php endif; ?>
                </ul>
                <form class="search">
                    <input type="search" placeholder="Buscar...">
                    <button class="btn-search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>
        </nav>
    </header>

    <section class="banner">
        <div class="content-banner">
            <p>Layout | Profile | Material</p>
            <h2>Keycaps<br></h2>
        </div>
    </section>

    <section class="container top-products">
        <div class="container-products">
            <div class="card-product">
                <div class="container-img">
                    <img src="imagenes/85bd8073326507e546d123d5581aeffc_b7682b60-c2fd-44cc-9bd5-5926e2005e9a.webp" alt="Tokyo">
                    <span class="discount">-20%</span>
                </div>
                <div class="content-card-product">
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h3>World Tour Tokyo R2 (185-Key)</h3>
                    <p class="price">63.99€ <span>79.99€</span></p>
                </div>
            </div>
            <div class="card-product">
                <div class="container-img">
                    <img src="imagenes/9147a1eb98df3dc0e303cd5f3c740fc1.webp"
                        alt="BlackPink">
                </div>
                <div class="content-card-product">
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <h3>Black & Pink ASA Low (155-key)</h3>
                    <p class="price">49.90€</p>
                </div>
            </div>
            <div class="card-product">
                <div class="container-img">
                    <img src="imagenes/Mochi_Dango-Keycap-Set_170-key.webp" alt="MochiDango">
                </div>
                <div class="content-card-product">
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <h3>Mochi & Dango (170-key)</h3>
                    <p class="price">49.90€</p>
                </div>
            </div>
            <div class="card-product">
                <div class="container-img">
                    <img src="imagenes/OSA_826946ae-e462-4100-8656-117176acbb04.webp" alt="Retro">
                    <span class="discount">-30%</span>
                </div>
                <div class="content-card-product">
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h3>Palace (187-Key)</h3>
                    <p class="price">45.99€ <span>64.99€</span></p>
                </div>
            </div>
            <div class="card-product">
                <div class="container-img">
                    <img src="imagenes/OSA_ac1e0b12-e01e-4b29-8562-19e2ee6fdc95.webp" alt="Neon">
                    <span class="discount">-30%</span>
                </div>
                <div class="content-card-product">
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <h3>Starry Night (187-Key)</h3>
                    <p class="price">45.99€ <span>64.99€</span></p>
                </div>
            </div>
            <div class="card-product">
                <div class="container-img">
                    <img src="imagenes/OSA_b4e66e11-6ae3-4882-84aa-5c82d2448663.webp"
                        alt="Prismarina">
                    <span class="discount">-30%</span>
                </div>
                <div class="content-card-product">
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h3>Herb Garden (187-Key)</h3>
                    <p class="price">45.99€ <span>64.99€</span></p>
                </div>
            </div>
            <div class="card-product">
                <div class="container-img">
                    <img src="imagenes/SAL_f2899c32-5cfd-4458-bda8-74625ed4f92e.webp" alt="BlackYellow">
                </div>
                <div class="content-card-product">
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h3>Black & Gold ABS SAL (195-Key)</h3>
                    <p class="price">39.99€ </p>
                </div>
            </div>
            <div class="card-product">
                <div class="container-img">
                    <img src="imagenes/WOBMDA.webp" alt="BlackRetro">
                </div>
                <div class="content-card-product">
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <h3>WOB Building Blocks (282-Key)</h3>
                    <p class="price">39.99€ </p>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer1">
            <div class="box">
                <figure>
                    <a href="index.php">
                        <img src="imagenes/logo-switch's-horizontal.png" alt="Logo Switch-e">
                    </a>
                </figure>
            </div>
            <div class="box">
                <h2>Categor&iacute;as</h2>
                <p>Keyboards</p>
                <p>Keycaps</p>
                <p>Switches</p>
                <p>Contacto</p>
            </div>
            <div class="box">
                <h2>M&eacute;todos de Pago</h2>
                <p>Visa</p>
                <p>MasterCard</p>
                <p>PayPal</p>
                <p>ApplePay</p>
            </div>
            <div class="box">
                <h2>S&iacute;guenos</h2>
                <div class="redsocial">
                    <a href="https://www.facebook.com/akkogear.eu?ref=12e4z440" target="_blank" class="fa-brands fa-facebook"></a>
                    <a href="https://www.instagram.com/akkogear.de/?ref=12e4z440" target="_blank" class="fa-brands fa-instagram"></a>
                    <a href="https://twitter.com/akkogear_de?ref=12e4z440" target="_blank" class="fa-brands fa-x-twitter"></a>
                    <a href="https://www.youtube.com/@akkogeareu" target="_blank" class="fa-brands fa-youtube"></a>
                    <a href="https://www.tiktok.com/@akkogear.de?ref=12e4z440" target="_blank" class="fa-brands fa-tiktok"></a>
                </div>
            </div>
        </div>
        <div class="footer2">
            <small>&copy; 2023 <b>Switch's</b> - Todos los Derechos Reservados.</small>
        </div>
    </footer>
</body>

</html>