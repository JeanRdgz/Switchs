<?php
session_name("login");
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Switch's Keyboards</title>
    <style>
        @import url(usuario.css);
    </style>
    <script src="https://kit.fontawesome.com/637af3b88f.js" crossorigin="anonymous"></script>
    <script>
        function ingresar() {
            form.action = "index.php";
            form.submit();
        }

        function registrarse() {
            form.action = "registrarse.php";
            form.submit();
        }
    </script>
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
                    <i class="fa-solid fa-headset"></i>
                    <div class="contact">
                        <span>Soporte al cliente</span>
                        <span>123-456-7890</span>
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
                    <li><a href="#">Usuario</a></li>
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
        <div class="contenedor">
            <div class="box-info">
                <h1>Ingresa tu Usuario</h1>
                <div class="data">
                    <p><i class="fa-solid fa-phone"></i>123-456-7890</p>
                    <p><i class="fa-solid fa-envelope"></i>switchs@gmail.com</p>
                    <p><i class="fa-solid fa-location-dot"></i>Uria Nº17, Oviedo</p>
                </div>
            </div>
            <form method="get" name="form">
                <div class="input-box">
                    <input type="text" id="user" name="user" required placeholder="ID del usuario">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="input-box">
                    <input type="password" id="pass" name="pass" required placeholder="Contraseña">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <button type="submit" onclick="ingresar()">Ingresar</button>
                <button type="submit" onclick="registrarse()">Registrarse</button>
            </form>
        </div>
    </section>

    <footer>
        <div class="footer1">
            <div class="box">
                <figure>
                    <a href="#">
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
                    <a href="https://www.facebook.com/akkogear.eu?ref=12e4z440" target="_blank"
                        class="fa-brands fa-facebook"></a>
                    <a href="https://www.instagram.com/akkogear.de/?ref=12e4z440" target="_blank"
                        class="fa-brands fa-instagram"></a>
                    <a href="https://twitter.com/akkogear_de?ref=12e4z440" target="_blank"
                        class="fa-brands fa-x-twitter"></a>
                    <a href="https://www.youtube.com/@akkogeareu" target="_blank" class="fa-brands fa-youtube"></a>
                    <a href="https://www.tiktok.com/@akkogear.de?ref=12e4z440" target="_blank"
                        class="fa-brands fa-tiktok"></a>
                </div>
            </div>
        </div>
        <div class="footer2">
            <small>&copy; 2023 <b>Switch's</b> - Todos los Derechos Reservados.</small>
        </div>
    </footer>
</body>

</html>