<?php
session_start();

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: keyboards.php");
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
        @import url(keyboards.css);
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
            <p>ISO Layout | Tri-mode | Gasket Mode</p>
            <h2>Keyboards<br></h2>
        </div>
    </section>

    <section class="container top-products">
        <div class="container-products">
            <div class="card-product">
                <div class="container-img">
                    <img src="imagenes/MOD-007B-HE-PC-Santorini-1.webp" alt="Santorini">
                    <span class="discount">-15%</span>
                </div>
                <div class="content-card-product">
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <h3>MOD 007B HE PC Santorini</h3>
                    <p class="price">127.50€ <span>149.99€</span></p>
                </div>
            </div>
            <div class="card-product">
                <div class="container-img">
                    <img src="imagenes/MOD-007B-PC-Tokyo-R2-1_0f930903-49ac-4c37-adab-3775ddee6853.webp"
                        alt="TokyoR2">
                    <span class="discount">-15%</span>
                </div>
                <div class="content-card-product">
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <h3>MOD 007B HE PC Tokyo R2</h3>
                    <p class="price">127.50€ <span>149.99€</span></p>
                </div>
            </div>
            <div class="card-product">
                <div class="container-img">
                    <img src="imagenes/Black-Silver-5075B-Plus-ISO-DE-1.webp" alt="BlackSilver">
                    <span class="discount">-10%</span>
                </div>
                <div class="content-card-product">
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h3>Black & Silver 5075B Plus ISO</h3>
                    <p class="price">90.00€ <span>99.99€</span></p>
                </div>
            </div>
            <div class="card-product">
                <div class="container-img">
                    <img src="imagenes/MOD007B-HE-White-Palace-1.webp" alt="WhitePalace">
                    <span class="discount">-20%</span>
                </div>
                <div class="content-card-product">
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <h3>MOD 007B HE</h3>
                    <p class="price">168.90€ <span>209.99€</span></p>
                </div>
            </div>
            <div class="card-product">
                <div class="container-img">
                    <img src="imagenes/MOD007BPCBlueonWhite.webp" alt="BlueonWhite">
                </div>
                <div class="content-card-product">
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <h3>MOD 007B PC Blue on White</h3>
                    <p class="price">109.90€</p>
                </div>
            </div>
            <div class="card-product">
                <div class="container-img">
                    <img src="imagenes/MOD-007pc_e3aa5b02-ed1f-477a-8cc6-58b7547e110b.webp"
                        alt="Character">
                </div>
                <div class="content-card-product">
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h3>7th Anniversary MOD 007B HE PC</h3>
                    <p class="price">149.90€</p>
                </div>
            </div>
            <div class="card-product">
                <div class="container-img">
                    <img src="imagenes/Black-on-White-5075B-Plus-ISO-DE-1.webp" alt="BlackOnWhite">
                </div>
                <div class="content-card-product">
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h3>Black on White 5075B Plus ISO</h3>
                    <p class="price">99.90€</p>
                </div>
            </div>
            <div class="card-product">
                <div class="container-img">
                    <img src="imagenes/MonsGeek-M1W-Black-3.webp" alt="MonsGeek">
                </div>
                <div class="content-card-product">
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <h3>MonsGeek M1W SP</h3>
                    <p class="price">219.90€</p>
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