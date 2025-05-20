<link rel="stylesheet" href="../assets/css/header.css">
<header class="main-header">
    <div class="header-top">
        <div class="logo">
            <a href="index.php">
                <img src="../assets/images/logo.png" alt="Logo">
            </a>
        </div>
        <div class="header-icons">
            <?php if (isset($_SESSION["usuario"]) && !empty($_SESSION["usuario"])): ?>
                <span class="welcome-message">
                    <i class="fa-solid fa-user"></i> ¡Hola, <?php echo htmlspecialchars($_SESSION["usuario"]); ?>!
                </span>
                <form method="POST" action="../controllers/logoutController.php" style="display:inline;">
                    <button type="submit" class="logout-button">Cerrar sesión</button>
                </form>
            <?php else: ?>
                <a href="../pages/login.php" class="user-icon"><i class="fa-solid fa-user"></i></a>
            <?php endif; ?>
            <a href="../pages/carrito.php"><i class="fa-solid fa-cart-shopping"></i></a>
            <button class="menu-toggle" id="menu-toggle">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
    </div>
    <nav class="nav" id="nav">
        <ul class="nav-menu">
            <li><a href="../pages/index.php">Inicio</a></li>
            <li><a href="../pages/products.php">Productos</a></li>
            <li><a href="../pages/personalizar.php">Personalizar</a></li>
            <li><a href="../pages/contact.php">Contacto</a></li>
        </ul>
    </nav>
</header>
<script src="../assets/js/header.js"></script>
<script src="https://kit.fontawesome.com/637af3b88f.js" crossorigin="anonymous"></script>