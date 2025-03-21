<?php
session_start();

$host = "localhost";
$dbname = "switchsbd";
$user = "root"; // Usuario por defecto en XAMPP
$password = ""; // Sin contraseña por defecto en XAMPP

try {
    // Conectar a la base de datos con PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

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
        echo "Inicio de sesión exitoso. ¡Bienvenido " . $_SESSION["usuario"] . "!";
    } else {
        echo "Correo o contraseña incorrectos.";
    }
}

// Manejar el registro de usuario
if (isset($_POST["register"])) {
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $direccion = $_POST["direccion"];
    $password = password_hash($_POST["contraseña"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO Usuario (nombre, correo, dirección_envío, contraseña, fecha_registro) 
            VALUES (:nombre, :correo, :direccion, :password, NOW())";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
    $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
    $stmt->bindParam(":direccion", $direccion, PDO::PARAM_STR);
    $stmt->bindParam(":password", $password, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "Usuario registrado correctamente.";
    } else {
        echo "Error en el registro.";
    }
}
