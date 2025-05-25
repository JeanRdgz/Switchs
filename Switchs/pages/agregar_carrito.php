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

if (!$id_usuario) {
    echo json_encode([
        "success" => false,
        "message" => "Debes iniciar sesión para agregar productos al carrito."
    ]);
    exit;
}

// Recoge productos individuales
$id_producto = isset($_POST['id_producto']) ? intval($_POST['id_producto']) : 0;
$cantidad = isset($_POST['cantidad']) ? intval($_POST['cantidad']) : 0;

// Recoge productos personalizados (kits, switches, keycaps)
$ids_personalizados = [];
if (isset($_POST['id_kit']) && intval($_POST['id_kit']) > 0) {
    $ids_personalizados[] = intval($_POST['id_kit']);
}
if (isset($_POST['id_switch']) && intval($_POST['id_switch']) > 0) {
    $ids_personalizados[] = intval($_POST['id_switch']);
}
if (isset($_POST['id_keycap']) && intval($_POST['id_keycap']) > 0) {
    $ids_personalizados[] = intval($_POST['id_keycap']);
}

if (
    ($id_producto <= 0 || $cantidad <= 0) &&
    empty($ids_personalizados)
) {
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

    // Si es producto individual
    if ($id_producto > 0 && $cantidad > 0) {
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
    }

    // Si es combo personalizado
    foreach ($ids_personalizados as $id) {
        $stmt = $pdo->prepare("SELECT cantidad FROM carrito_producto WHERE id_carrito = ? AND id_producto = ?");
        $stmt->execute([$id_carrito, $id]);
        $carrito_producto = $stmt->fetch();

        if ($carrito_producto) {
            $nueva_cantidad = $carrito_producto['cantidad'] + 1;
            $stmt = $pdo->prepare("UPDATE carrito_producto SET cantidad = ? WHERE id_carrito = ? AND id_producto = ?");
            $stmt->execute([$nueva_cantidad, $id_carrito, $id]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO carrito_producto (id_carrito, id_producto, cantidad) VALUES (?, ?, 1)");
            $stmt->execute([$id_carrito, $id]);
        }
    }

    echo json_encode([
        'success' => true,
        'message' => 'Producto(s) agregado(s) correctamente.'
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al agregar al carrito: ' . $e->getMessage()
    ]);
}
