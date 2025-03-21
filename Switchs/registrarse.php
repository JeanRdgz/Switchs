<?php
session_name("login");
session_start();

function recogerValor($key)
{
    if (isset($_POST['registrar'])) {
        $nombre = trim(htmlspecialchars($_POST['nombre']));
        $correo = trim(htmlspecialchars($_POST['correo']));
        $contraseña = trim(htmlspecialchars($_POST['contraseña']));
        $direccion_envio = trim(htmlspecialchars($_POST['direccion_envio']));

        registrarUsuario($nombre, $correo, $contraseña, $direccion_envio);
    }
}

function conectarDB()
{
    /*
    $host = "bjssmrmaigacpgmt17yc-mysql.services.clever-cloud.com";
    $database = "bjssmrmaigacpgmt17yc";
    $user = "umchoavprplzg52n";
    $pass = "Ot1xIiJMG0qFmMdfQoBX";
    */
    $host = "localhost";
    $database = "switchsbd";
    $user = "root";
    $pass = "";


    /*
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
    */
    try {
        $con = new PDO(
            "mysql:host=$host;dbname=$database;charset=utf8",
            $user,
            $pass
        );
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $con;
    } catch (PDOException $e) {
        die("Error al conectar con la base de datos: " . $e->getMessage());
    }
}

/*
function guardarDatos($user, $pass)
{
    $pdo = conectarDB();
    if ($pdo != null) {
        $consulta = "INSERT INTO base VALUES" . "(:paramUser,:paramPass)";
        $resul = $pdo->prepare($consulta);
        if ($resul != null) {
            try {
                if ($resul->execute(["paramUser" => $user, "paramPass" => $pass])) {
                    echo "<div id='message' class='message success'>Nuevo usuario insertado: $user</div>";
                }
            } catch (PDOException $e) {
                if ($e->getCode() == 23000) {
                    echo "<div id='message' class='message error'>¡ERROR!, usuario $user registrado</div>";
                } else {
                    echo "<div id='message' class='message error'>¡ERROR!, resgistro NO insertado</div>";
                }
            }
        }
    }
}^
*/
function registrarUsuario($nombre, $correo, $contraseña, $direccion_envio)
{
    $consulta = "INSERT INTO usuario (nombre, correo, contraseña, direccion_envio, fecha_registro) 
                 VALUES (:nombre, :correo, :contraseña, :direccion_envio, CURDATE())";
    $pdo = conectarDB();
    try {
        $resul = $pdo->prepare($consulta);
        $resul->execute([
            "nombre" => $nombre,
            "correo" => $correo,
            "contraseña" => password_hash($contraseña, PASSWORD_BCRYPT),
            "direccion_envio" => $direccion_envio
        ]);
        echo "<div id='message' class='message'>Usuario registrado correctamente</div>";
    } catch (PDOException $e) {
        echo "<div id='message' class='message'>ERROR al registrar usuario: " . $e->getMessage() . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Switch's Keyboards</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url(style2.css);

        body {
            color: white;
        }

        .message {
            padding: 10px;
            border-radius: 5px;
            z-index: 1500;
        }

        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .message.error {
            background-color: #f8d7da;
            color: rgb(212, 12, 32);
            border: 1px solid #f5c6cb;
        }
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
                    <li><a href="#">Keyboards</a></li>
                    <li><a href="#">Keycaps</a></li>
                    <li><a href="#">Switches</a></li>
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
        <div class="contenedor">
            <div class="box-info">
                <h1>Registrarse</h1><br>
                <form method="POST" action="index.php">
                    <h2>Registro</h2>
                    <input type="text" name="nombre" placeholder="Nombre" required>
                    <input type="email" name="correo" placeholder="Correo" required>
                    <input type="password" name="contraseña" placeholder="Contraseña" required>
                    <textarea name="direccion_envio" placeholder="Dirección de envío" required></textarea>
                    <button type="submit" name="registrar">Registrar</button>
                </form>
                <?php
                $user = recogerValor("user");
                $pass = recogerValor("pass");

                if ($user != "" && $pass != "") {
                    registrarUsuario($nombre, $correo, $contraseña, $direccion_envio);
                } else {
                    echo "<div id='message' class='message error'>¡ERROR!, campos vacios</div>";
                }
                ?>
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