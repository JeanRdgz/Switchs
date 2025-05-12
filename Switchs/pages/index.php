<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Switch's</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <script src="https://kit.fontawesome.com/637af3b88f.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include '../components/header.php'; ?>
    <main>
        <div class="slider">
            <div class="slide">
                <img src="../assets/images/slider1.webp" alt="Slider 1">
                <div class="slide-overlay"></div>
            </div>
            <div class="slide">
                <img src="../assets/images/slider2.webp" alt="Slider 2">
                <div class="slide-overlay"></div>
            </div>
            <div class="slide">
                <img src="../assets/images/slider3.webp" alt="Slider 3">
                <div class="slide-overlay"></div>
            </div>
            <div class="slide">
                <img src="../assets/images/slider4.webp" alt="Slider 4">
                <div class="slide-overlay"></div>
            </div>
        </div>
    </main>
    <?php include '../components/footer.php'; ?>
    <script src="../assets/js/slider.js"></script>
</body>

</html>