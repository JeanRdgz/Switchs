<?php
session_start();

$host = "localhost";
$dbname = "switchsbd";
$user = "root";
$password = "";

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
        header("Location: index.php");
        exit();
    } else {
        $_SESSION["error_message"] = "Correo o contraseña incorrectos.";
        header("Location: usuario.php");
        exit();
    }
}

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
        header("Location: registrarse.php");
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
        header("Location: index.php");
        exit();
    } else {
        $_SESSION["error_message"] = "Error en el registro. Por favor, intente nuevamente.";
        header("Location: registrarse.php");
        exit();
    }
}
