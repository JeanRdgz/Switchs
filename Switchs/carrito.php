<?php
require_once "utilidades.php";

$listaUsuarios = leerJSON("datos/usuarios.json");
$nombreUsuario = $_GET['usuario'] ?? '';

if ($nombreUsuario === '') {
    echo json_encode(["mensaje" => "Se requiere un nombre de usuario"]);
    exit;
}

foreach ($listaUsuarios as &$datosUsuario) {
    if ($datosUsuario['nombreUsuario'] === $nombreUsuario) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            echo json_encode($datosUsuario['carrito']);
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = json_decode(file_get_contents('php://input'), true);
            $idProducto = $datos['idProducto'];
            $listaProductos = leerJSON("datos/productos.json");

            foreach ($listaProductos as $producto) {
                if ($producto['id'] == $idProducto) {
                    $encontrado = false;
                    foreach ($datosUsuario['carrito'] as &$itemCarrito) {
                        if ($itemCarrito['id'] == $idProducto) {
                            $itemCarrito['cantidad'] = ($itemCarrito['cantidad'] ?? 1) + 1;
                            $encontrado = true;
                            break;
                        }
                    }
                    if ($encontrado === false) {
                        $producto['cantidad'] = 1;
                        $datosUsuario['carrito'][] = $producto;
                    }
                    escribirJSON("datos/usuarios.json", $listaUsuarios);
                    echo json_encode(["mensaje" => "Producto agregado", "carrito" => $datosUsuario['carrito']]);
                    exit;
                }
            }
            echo json_encode(["mensaje" => "Producto no encontrado"]);
        } elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $datos = json_decode(file_get_contents('php://input'), true);
            $idProducto = $datos['idProducto'];
            $datosUsuario['carrito'] = array_values(array_filter($datosUsuario['carrito'], fn($item) => $item['id'] != $idProducto));
            escribirJSON("datos/usuarios.json", $listaUsuarios);
            echo json_encode(["mensaje" => "Producto eliminado del carrito", "carrito" => $datosUsuario['carrito']]);
        } elseif ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
            $datos = json_decode(file_get_contents('php://input'), true);
            $idProducto = $datos['idProducto'];
            $cambioCantidad = $datos['delta'];

            foreach ($datosUsuario['carrito'] as &$itemCarrito) {
                if ($itemCarrito['id'] == $idProducto) {
                    $itemCarrito['cantidad'] = ($itemCarrito['cantidad'] ?? 1) + $cambioCantidad;
                    if ($itemCarrito['cantidad'] <= 0) {
                        $datosUsuario['carrito'] = array_values(array_filter($datosUsuario['carrito'], fn($item) => $item['id'] != $idProducto));
                    }
                    escribirJSON("datos/usuarios.json", $listaUsuarios);
                    echo json_encode(["mensaje" => "Cantidad actualizada", "carrito" => $datosUsuario['carrito']]);
                    exit;
                }
            }
            echo json_encode(["mensaje" => "Producto no encontrado en el carrito"]);
        }
        exit;
    }
}

echo json_encode(["mensaje" => "Usuario no encontrado"]);
