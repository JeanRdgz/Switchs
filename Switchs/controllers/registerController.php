<?php
session_start();

// Incluir la configuración de la base de datos
require_once '../includes/config.php'; 

// Manejar el registro de usuario
if (isset($_POST["register"])) {
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $direccion = $_POST["direccion"];
    $password = password_hash($_POST["contraseña"], PASSWORD_DEFAULT);

    // Verificar si el correo ya existe
    $checkEmailSql = "SELECT COUNT(*) FROM Usuario WHERE correo = :correo";
    $checkStmt = $pdo->prepare($checkEmailSql);
    $checkStmt->bindParam(":correo", $correo, PDO::PARAM_STR);
    $checkStmt->execute();
    $emailExists = $checkStmt->fetchColumn();

    if ($emailExists) {
        $_SESSION["error_message"] = "Usuario ya existente. Por favor, use otro correo.";
        header("Location: ../pages/register.php");
        exit();
    }

    $sql = "INSERT INTO Usuario (nombre, correo, dirección_envío, contraseña, fecha_registro) 
            VALUES (:nombre, :correo, :direccion, :password, NOW())";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
    $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
    $stmt->bindParam(":direccion", $direccion, PDO::PARAM_STR);
    $stmt->bindParam(":password", $password, PDO::PARAM_STR);

    if ($stmt->execute()) {
        $_SESSION["usuario"] = $nombre;
        header("Location: ../pages/index.php");
        exit();
    } else {
        $_SESSION["error_message"] = "Error en el registro. Por favor, intente nuevamente.";
        header("Location: ../pages/register.php");
        exit();
    }
}