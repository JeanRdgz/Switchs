<?php
session_start();
require_once '../includes/config.php';

$id_usuario = $_SESSION['id_usuario'] ?? null;
$id_producto = $_POST['id_producto'] ?? null;

if (!$id_usuario || !$id_producto) {
    header("Location: carrito.php");
    exit;
}

// Obtener el id_carrito del usuario
$stmt = $pdo->prepare("SELECT id_carrito FROM Carrito WHERE id_usuario = ?");
$stmt->execute([$id_usuario]);
$carrito = $stmt->fetch(PDO::FETCH_ASSOC);

if ($carrito) {
    $id_carrito = $carrito['id_carrito'];
    // Eliminar el producto del carrito
    $stmt = $pdo->prepare("DELETE FROM Carrito_producto WHERE id_carrito = ? AND id_producto = ?");
    $stmt->execute([$id_carrito, $id_producto]);
}

header("Location: carrito.php");
exit;
