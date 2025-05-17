<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Switch's - Contáctanos</title>
    <link rel="stylesheet" href="../assets/css/contact.css">
    <script src="https://kit.fontawesome.com/637af3b88f.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include '../components/header.php'; ?>
    <main class="contact-bg">
        <div style="width:100%;max-width:1200px;margin:0 auto;padding:40px 10px;">
            <div class="contact-support-title">Contáctanos</div>
            <div class="contact-main-row">
                <div style="flex:1;min-width:260px;">
                    <div class="contact-support-section">
                        <strong>¿Necesitas ayuda?</strong>
                        <div class="data">
                            <p><i class="fa-solid fa-clock"></i><b>Horario de atención :</b></p>
                        </div>
                        Lunes a Sábado: 9:00 - 22:00<br>
                        Domingos: 10:00 - 18:00
                        <br><br>
                        <span>¿Tienes dudas sobre tu pedido, pago o envío? Consulta aquí:</span>
                        <ul>
                            <li><a href="#">¿Dónde está mi pedido?</a></li>
                            <li><a href="#">¿Cómo puedo devolver un producto?</a></li>
                            <li><a href="#">¿Cuáles son los métodos de pago?</a></li>
                            <li><a href="#">¿Cuánto tarda el envío?</a></li>
                            <li><a href="#">Ver todas las preguntas frecuentes</a></li>
                        </ul>
                        <div class="data">
                            <p><i class="fa-solid fa-phone"></i>123-456-7890</p>
                            <p><i class="fa-solid fa-envelope"></i>switchs@gmail.com</p>
                            <p><i class="fa-solid fa-location-dot"></i>Uria Nº17, Oviedo</p>
                        </div>
                    </div>
                </div>
                <div class="contact-form-box">
                    <form>
                        <div style="display:flex;gap:1rem;">
                            <input type="text" name="nombre" required placeholder="Nombre">
                            <input type="email" name="correo" required placeholder="Correo electrónico">
                        </div>
                        <select name="tipo_soporte" required>
                            <option value="">Tipo de consulta</option>
                            <option value="pedido">Pedido</option>
                            <option value="producto">Producto</option>
                            <option value="otro">Otro</option>
                        </select>
                        <input type="text" name="id_pedido" placeholder="ID de pedido (opcional)">
                        <input type="text" name="producto" placeholder="Nombre/Tipo de producto (opcional)">
                        <textarea name="mensaje" required placeholder="Mensaje"></textarea>
                        <button type="submit">Enviar mensaje</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php include '../components/footer.php'; ?>
</body>

</html>