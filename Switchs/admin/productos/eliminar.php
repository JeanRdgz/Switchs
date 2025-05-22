<?php
require_once '../../includes/config.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID no especificado.";
    exit;
}

try {
    $stmt = $pdo->prepare("DELETE FROM Producto WHERE id_producto = :id");
    $stmt->execute([':id' => $id]);
    header("Location: listar.php?mensaje=eliminado");
    exit;
} catch (PDOException $e) {
    echo "Error al eliminar: " . $e->getMessage();
}
