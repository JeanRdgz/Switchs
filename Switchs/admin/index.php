<?php
session_start();
if (!isset($_SESSION['admin'])) {
    $_SESSION['admin'] = true;
}

include 'templates/header.php';
include 'templates/sidebar.php';
?>

<!-- Contenido principal del dashboard -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Bienvenido al Panel de Administración</h1>
    <p>Desde aquí puedes gestionar productos y otras funcionalidades.</p>
</div>

<?php include 'templates/footer.php'; ?>