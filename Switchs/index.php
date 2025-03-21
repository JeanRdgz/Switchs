<?php
session_name("login");
session_start();

if (!isset($_SESSION['initialized'])) {
    session_unset();
    $_SESSION['initialized'] = true;
}

$valorUser = "";
if (isset($_REQUEST["user"])) {
    $valorUser = trim(htmlspecialchars($_REQUEST["user"]));
    $_SESSION["user"] = $valorUser;
} else {
    $_SESSION["error"] = "No se ha introducido usuario";
}

$valorPass = "";
if (isset($_REQUEST["pass"])) {
    $valorPass = trim(htmlspecialchars($_REQUEST["pass"]));
    $_SESSION["pass"] = $valorPass;
} else {
    $_SESSION["error"] = "No se ha introducido password";
}

function recogerValor($key)
{
    $valor = "";
    if (isset($_REQUEST[$key])) {
        $valor = trim(htmlspecialchars($_REQUEST[$key]));
    } else {
        $valor = "error";
    }
    return $valor;
}

function conectarDB()
{
    $host = "bjssmrmaigacpgmt17yc-mysql.services.clever-cloud.com";
    $database = "bjssmrmaigacpgmt17yc";
    $user = "umchoavprplzg52n";
    $pass = "Ot1xIiJMG0qFmMdfQoBX";

    try {
        $con = new pdo(
            "mysql:host=$host;dbname=$database",
            $user,
            $pass
        );
        return $con;
    } catch (PDOException $e) {
        print "ERROR excepcion pdo";
    }
}

function consultaPass($user, $pass)
{
    $consulta = "SELECT * FROM base WHERE user=:param";
    $pdo = conectarDB();
    $resul = $pdo->prepare($consulta);
    if ($resul != null) {
        $resul->execute(["param" => $user]);
        $registro = $resul->fetch();

        if ($registro == null) {
            echo "<div id='message' class='message'>ERROR usuario no encontrado</div>";
            echo "<script>
                    setTimeout(function() {
                        document.getElementById('message').style.display = 'none';
                    }, 1500);
                  </script>";
            unset($_SESSION['user']);
            return false;
        }
        if ($pass == $registro["pass"]) {
            $_SESSION['user'] = $user;
            echo "<div id='message' class='message'>usuario y contraseña correcto</div>";
            echo "<script>
                    setTimeout(function() {
                        document.getElementById('message').style.display = 'none';
                    }, 1500);
                  </script>";
            return true;
        } else {
            echo "<div id='message' class='message'>ERROR contraseña incorrecta</div>";
            echo "<script>
                    setTimeout(function() {
                        document.getElementById('message').style.display = 'none';
                    }, 1500);
                  </script>";
            unset($_SESSION['user']);
            return false;
        }
    } else {
        echo "<div id='message' class='message'>ERROR al preparar la consulta</div>";
        echo "<script>
                setTimeout(function() {
                    document.getElementById('message').style.display = 'none';
                }, 1500);
              </script>";
        unset($_SESSION['user']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Switch's Keyboards</title>
    <style>
        @import url(style.css);

        .message {
            position: fixed;
            top: 25px;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgb(233, 226, 233);
            color: #7d2181;
            padding: 10px;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            z-index: 1000;
        }
    </style>
    <script src="https://kit.fontawesome.com/637af3b88f.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    $pdo = conectarDB();
    $user = recogerValor("user");
    $pass = recogerValor("pass");
    consultaPass($user, $pass);
    ?>
    <header>
        <div class="container-hero">
            <div class="container hero">
                <div class="logo">
                    <a href="index.php">
                        <img src="imagenes/logo-switch's-horizontal.png" width="250px">
                    </a>
                </div>
                <div class="customer">
                    <i class="fa-solid fa-user"></i>
                    <div class="user">
                        <?php if (isset($_SESSION['user'])): ?>
                            <span><?php echo htmlspecialchars($_SESSION['user']); ?></span>
                        <?php endif; ?>
                        <span>Saludos ;)</span>
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
                    <li><a href="usuario.php">Usuario</a></li>
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
            <h2>Black and Silver 5075B Plus ISO<br></h2>
            <a href="#">Comprar Ahora</a>
        </div>
    </section>

    <article class="container container-article">
        <div class="card-article">
            <i class="fa-solid fa-plane-up"></i>
            <div class="article-content">
                <span>Envio gratuito</span>
                <p>En pedido superior a 59.99€</p>
            </div>
        </div>
        <div class="card-article">
            <i class="fa-solid fa-wallet"></i>
            <div class="article-content">
                <span>Pago seguro</span>
                <p>100% garant&iacute;a</p>
            </div>
        </div>
        <div class="card-article">
            <i class="fa-solid fa-gift"></i>
            <div class="article-content">
                <span>Tarjeta regalo</span>
                <p>Bonos especiales con regalo</p>
            </div>
        </div>
        <div class="card-article">
            <i class="fa-solid fa-headset"></i>
            <div class="article-content">
                <span>Servicio al cliente 24/7</span>
                <p>Ll&aacute;menos al 123-456-7890</p>
            </div>
        </div>
    </article>

    <main class="container top-category">
        <h1 class="title">Mejores Categor&iacute;as</h1>
        <div class="container-category">
            <div class="card-category category-keyboards">
                <p>Keyboards</p>
                <span><a href="keyboards.php">Ver m&aacute;s</a></span>
            </div>
            <div class="card-category category-keycaps">
                <p>Keycaps</p>
                <span><a href="keycaps.php">Ver m&aacute;s</a></span>
            </div>
            <div class="card-category category-switches">
                <p>Switches</p>
                <span><a href="switches.php">Ver m&aacute;s</a></span>
            </div>
        </div>
    </main>

    <section class="container top-products">
        <h1 class="title">Mejores Productos</h1>
        <div class="container-options">
            <span class="active">Destacados</span>
            <span>M&aacute;s recientes</span>
            <span>M&aacute;s vendidos</span>
        </div>
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
                        alt="Santorini">
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
                    <img src="imagenes/Black-Silver-5075B-Plus-ISO-DE-1.webp" alt="Santorini">
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
                    <img src="imagenes/MOD007B-HE-White-Palace-1.webp" alt="Santorini">
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
        </div>
    </section>

    <h1 class="title">Estructura del keyboard</h1>
    <figure class="container imagen">
        <img src="imagenes/5075-Structure-D.webp" width="80%">
        <figcaption>
            <h4>Estructura del keyboard, uno a uno apreciamos los componentes que la conforman</h4>
        </figcaption>
    </figure>

    <h1 class="title">Conectividad</h1>
    <figure class="container imagen">
        <img src="imagenes/Black-Silver-5075B-Plus-Multi-Mode-3200-1600.webp" width="80%">
        <figcaption>
            <h4>Simultaneidad conectando por Bluetooth (Hasta dos dispositivos), Dongle USB y por cable mayado con
                conectividad USB Type-C</h4>
        </figcaption>
    </figure>

    <footer>
        <div class="container footer1">
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
        <div class="container-footer2">
            <div class="container footer2">
                <small>&copy; 2023 <b>Switch's</b> - Todos los Derechos Reservados.</small>
            </div>
        </div>
    </footer>
</body>

</html>