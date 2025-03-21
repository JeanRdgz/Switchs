<?php
require_once "utilidades.php";

$nombreUsuario = $_GET['usuario'] ?? '';
if ($nombreUsuario === '') {
    echo "Error: Nombre de usuario no proporcionado";
    exit;
}

$listaProductos = leerJSON("datos/productos.json");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="centrar">
    <div class="productos-container">
        <h1>Bienvenido, <?php echo htmlspecialchars($nombreUsuario); ?></h1>
        <button onclick="cerrarSesion()">Cerrar sesión</button>
        <h2>Lista de productos</h2>
        <ul>
            <?php foreach ($listaProductos as $producto): ?>
                <li>
                    <?php echo htmlspecialchars($producto['nombre']) . " - $" . $producto['precio']; ?>
                    <button onclick="agregarAlCarrito(<?php echo $producto['id']; ?>)">Agregar al carrito</button>
                </li>
            <?php endforeach; ?>
        </ul>
        <button onclick="mostrarCarrito()">Ver carrito</button>
        <div id="carrito" style="display:none;">
            <h2>Carrito</h2>
            <ul id="items-carrito"></ul>
        </div>
    </div>
    <script>
        const usuario = "<?php echo urlencode($nombreUsuario); ?>";

        function cerrarSesion() {
            location.href = "inicio.php";
        }

        function agregarAlCarrito(idProducto) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', `carrito.php?usuario=${usuario}`, true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.send(JSON.stringify({ idProducto }));
            xhr.onload = mostrarCarrito;
        }

        function mostrarCarrito() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', `carrito.php?usuario=${usuario}`, true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    const carrito = JSON.parse(xhr.responseText);
                    const itemsCarrito = document.getElementById('items-carrito');
                    itemsCarrito.innerHTML = carrito.map(item => `
                        <li>
                            ${item.nombre} - $${item.precio} - Cantidad: ${item.cantidad || 1}
                            <button onclick="actualizarCantidad(${item.id}, 1)">+</button>
                            <button onclick="actualizarCantidad(${item.id}, -1)">-</button>
                        </li>
                    `).join('');
                    document.getElementById('carrito').style.display = 'block';
                }
            };
            xhr.send();
        }

        function actualizarCantidad(idProducto, delta) {
            var xhr = new XMLHttpRequest();
            xhr.open('PATCH', `carrito.php?usuario=${usuario}`, true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.send(JSON.stringify({ idProducto, delta }));
            xhr.onload = mostrarCarrito;
        }
    </script>
</body>
</html>
