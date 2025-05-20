<?php
session_start();
require_once '../includes/config.php';

$error_message = isset($_SESSION["error_message"]) ? $_SESSION["error_message"] : "";
unset($_SESSION["error_message"]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'] ?? '';
    $password = $_POST['contraseña'] ?? '';

    $stmt = $pdo->prepare("SELECT id_usuario, nombre, contraseña FROM usuario WHERE correo = :correo LIMIT 1");
    $stmt->execute([':correo' => $correo]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['contraseña'])) {
        $_SESSION['id_usuario'] = $user['id_usuario'];
        $_SESSION['usuario'] = $user['nombre'];
        header("Location: products.php");
        exit;
    } else {
        $error_message = "Usuario o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Switch's</title>
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
                <h1>¿Listo para seguir explorando?</h1>
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
                <form method="POST" action="" name="form-ingresar">
                    <div class="input-box">
                        <input type="email" name="correo" required placeholder="Correo">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div class="input-box">
                        <input type="password" name="contraseña" required placeholder="Contraseña">
                        <i class="fa-solid fa-key"></i>
                    </div>
                    <button class="loginButton" type="submit" name="login">Iniciar Sesión</button>
                </form>
                <form method="get" action="../pages/register.php" name="form-registrarse">
                    <button type="submit">Registrarse</button>
                </form>
            </div>
        </div>
    </main>
    <?php include '../components/footer.php'; ?>
</body>

</html>