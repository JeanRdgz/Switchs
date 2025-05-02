<?php
session_start();

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: switches.php");
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
        @import url(switches.css);
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
            <p>Click | Linear | Tactil</p>
            <h2>Switches<br></h2>
        </div>
    </section>

    <section class="container top-products">
        <div class="container-products">
            <div class="card-product">
                <div class="container-img">
                    <img src="imagenes/V3-Cream-Black-Pro.webp" alt="CreamBlack">
                </div>
                <div class="content-card-product">
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <h3>V3 Cream Black Pro (45pcs)</h3>
                    <p class="price">11.99€</p>
                </div>
            </div>
            <div class="card-product">
                <div class="container-img">
                    <img src="imagenes/V3-Fairy-Pro-Switch.webp"
                        alt="Fairy">
                </div>
                <div class="content-card-product">
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <h3>Akko Fairy Silent (45pcs)</h3>
                    <p class="price">13.99€</p>
                </div>
            </div>
            <div class="card-product">
                <div class="container-img">
                    <img src="imagenes/V3-Lavender-Purple-Pro-Switch.webp" alt="Purple">

                </div>
                <div class="content-card-product">
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h3>V3 Lavender Purple Pro (45pcs)</h3>
                    <p class="price">9.99€</p>
                </div>
            </div>
            <div class="card-product">
                <div class="container-img">
                    <img src="imagenes/V3-Penguin-Pro-Switch-1.webp" alt="Penguin">
                </div>
                <div class="content-card-product">
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <h3>Akko Penguin Silent (45pcs)</h3>
                    <p class="price">13.99€</p>
                </div>
            </div>
            <div class="card-product">
                <div class="container-img">
                    <img src="imagenes/V3-Silver-Switch.webp" alt="Silver">
                </div>
                <div class="content-card-product">
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <h3>V3 Silver Pro (45pcs)</h3>
                    <p class="price">13.99€</p>
                </div>
            </div>
            <div class="card-product">
                <div class="container-img">
                    <img src="imagenes/V3CreamBlueProSwitch_17.webp"
                        alt="CreamBlue">
                </div>
                <div class="content-card-product">
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <h3>Akko Switch Pack (10pcs)</h3>
                    <p class="price">6.99€</p>
                </div>
            </div>
            <div class="card-product">
                <div class="container-img">
                    <img src="imagenes/V3CreamYellowProSwitch_2.webp" alt="CreamYellow">
                </div>
                <div class="content-card-product">
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <h3>V3 Cream Yellow Pro (45pcs)</h3>
                    <p class="price">8.99€</p>
                </div>
            </div>
            <div class="card-product">
                <div class="container-img">
                    <img src="imagenes/V3PianoProSwitch_New_45pcs.webp" alt="Piano">
                </div>
                <div class="content-card-product">
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <h3>V3 Piano Pro New (45pcs)</h3>
                    <p class="price">13.99€</p>
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