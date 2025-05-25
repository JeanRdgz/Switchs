<?php
session_start();
require_once '../includes/config.php'; 

// Manejar el inicio de sesión
if (isset($_POST["login"])) {
    $correo = $_POST["correo"];
    $password = $_POST["contraseña"];

    $sql = "SELECT * FROM Usuario WHERE correo = :correo";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["contraseña"])) {
        $_SESSION["usuario"] = $user["nombre"];
        header("Location: ../pages/index.php");
        exit();
    } else {
        $_SESSION["error_message"] = "Correo o contraseña incorrectos.";
        header("Location: ../pages/login.php");
        exit();
    }
}
