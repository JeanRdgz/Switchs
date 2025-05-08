<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Switch's - Contacto</title>
    <link rel="stylesheet" href="../assets/css/contact.css">
    <script src="https://kit.fontawesome.com/637af3b88f.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include '../components/header.php'; ?>
    <main class="contact-container">
        <div class="contact-banner"></div>
        <div class="contact-content">
            <div class="contact-info">
                <h1>Contáctanos</h1>
                <p><i class="fa-solid fa-phone"></i> Teléfono: 123-456-7890</p>
                <p><i class="fa-solid fa-envelope"></i> Email: switchs@gmail.com</p>
                <p><i class="fa-solid fa-location-dot"></i> Dirección: Uria Nº17, Oviedo</p>
            </div>
            <div class="map-container">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2906.912116774065!2d-5.849388684524537!3d43.36191497913286!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd368d8c1f0b1f3b%3A0x403f9f681f3e7e0!2sUria%2C%2017%2C%2033003%20Oviedo%2C%20Asturias%2C%20España!5e0!3m2!1ses!2ses!4v1697040000000!5m2!1ses!2ses" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </main>
    <?php include '../components/footer.php'; ?>
</body>

</html>
