<?php
session_start();
$error_message = isset($_SESSION["error_message"]) ? $_SESSION["error_message"] : "";
unset($_SESSION["error_message"]);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Switch's - Registro</title>
    <style>
        @import url(../assets/css/login.css);
        .error-message {
            color: white;
            font-size: 14px;
            margin-bottom: 10px;
            padding: 5px;
            border-radius: 5px;
            text-align: center;
        }
    </style>
    <script src="https://kit.fontawesome.com/637af3b88f.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include '../components/header.php'; ?>
    <main class="bannerLogin">
        <div class="contenedor">
            <div class="box-info">
                <h1>¡Únete a nuestra comunidad!</h1>
                <div class="data">
                    <p><i class="fa-solid fa-phone"></i>123-456-7890</p>
                    <p><i class="fa-solid fa-envelope"></i>switchs@gmail.com</p>
                    <p><i class="fa-solid fa-location-dot"></i>Uria Nº17, Oviedo</p>
                </div>
            </div>
            <div class="box-form">
                <?php if (!empty($error_message)): ?>
                    <div class="error-message"><?php echo $error_message; ?></div>
                <?php endif; ?>
                <form method="POST" action="../controllers/registerController.php" name="form-registrarse">
                    <div class="input-box">
                        <input type="text" name="nombre" required placeholder="Nombre">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="input-box">
                        <input type="text" name="direccion_envio" required placeholder="Dirección">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div class="input-box">
                        <input type="email" name="correo" required placeholder="Correo">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div class="input-box">
                        <input type="password" name="contraseña" required placeholder="Contraseña">
                        <i class="fa-solid fa-key"></i>
                    </div>
                    <button class="loginButton" type="submit" name="register">Registrarse</button>
                </form>
                <form method="get" action="../pages/login.php" name="form-ingresar">
                    <button type="submit">Iniciar Sesión</button>
                </form>
            </div>
        </div>
    </main>
    <?php include '../components/footer.php'; ?>
</body>
</html>
