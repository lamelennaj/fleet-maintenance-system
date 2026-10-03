<?php
session_start();
//Only ADMIN can execute this file
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../vistas/login.php");
    exit();
}

require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevo_usuario = trim($_POST['new_username']);
    $password_claro = trim($_POST['new_password']);
    $rol = $_POST['rol'];

    if (empty($nuevo_usuario) || empty($password_claro) || empty($rol)) {
        die("Error: Todos los campos son obligatorios.");
    }

    //Encryp password
    $password_encriptada = password_hash($password_claro, PASSWORD_BCRYPT);

    try {
        $sql = "INSERT INTO usuarios (username, password, rol) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nuevo_usuario, $password_encriptada, $rol]);

        header("Location: ../vistas/registro_usuarios.php?status=success");
        exit();

    } catch (PDOException $e) {
        die("Error al registrar el nuevo usuario (posiblemente ya existe el nombre de usuario): " . $e->getMessage());
    }
} else {
    header("Location: ../vistas/registro_usuarios.php");
    exit();
}