<?php
session_start();
header('Content-Type: application/json');
require_once '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "success" => false,
        "message" => "Método no permitido."
    ]);
    exit;
}

$id_usuario = $_SESSION['id_usuario'] ?? null;
$id_producto = isset($_POST['id_producto']) ? intval($_POST['id_producto']) : 0;
$cantidad = isset($_POST['cantidad']) ? intval($_POST['cantidad']) : 0;

if (!$id_usuario) {
    echo json_encode([
        "success" => false,
        "message" => "Debes iniciar sesión para agregar productos al carrito."
    ]);
    exit;
}
if (!$id_producto || $cantidad <= 0) {
    echo json_encode([
        "success" => false,
        "message" => "Datos inválidos."
    ]);
    exit;
}

try {
    // Buscar o crear carrito
    $stmt = $pdo->prepare("SELECT id_carrito FROM carrito WHERE id_usuario = ?");
    $stmt->execute([$id_usuario]);
    $carrito = $stmt->fetch();

    if (!$carrito) {
        $stmt = $pdo->prepare("INSERT INTO carrito (id_usuario) VALUES (?)");
        $stmt->execute([$id_usuario]);
        $id_carrito = $pdo->lastInsertId();
    } else {
        $id_carrito = $carrito['id_carrito'];
    }

    // Verificar si el producto ya está en el carrito
    $stmt = $pdo->prepare("SELECT cantidad FROM carrito_producto WHERE id_carrito = ? AND id_producto = ?");
    $stmt->execute([$id_carrito, $id_producto]);
    $carrito_producto = $stmt->fetch();

    if ($carrito_producto) {
        $nueva_cantidad = $carrito_producto['cantidad'] + $cantidad;
        $stmt = $pdo->prepare("UPDATE carrito_producto SET cantidad = ? WHERE id_carrito = ? AND id_producto = ?");
        $stmt->execute([$nueva_cantidad, $id_carrito, $id_producto]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO carrito_producto (id_carrito, id_producto, cantidad) VALUES (?, ?, ?)");
        $stmt->execute([$id_carrito, $id_producto, $cantidad]);
    }

    echo json_encode([
        'success' => true,
        'message' => 'Producto agregado correctamente.'
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al agregar al carrito: ' . $e->getMessage()
    ]);
}

