<?php
session_start();
//validates user's session is active and if we got its ID
if (!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
    header("Location: ../vistas/login.php");
    exit();
}

require_once 'conexion.php';

//Process all POST data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_coche = $_POST['id_coche'];
    $tipo = trim($_POST['tipo']);
    $descripcion = trim($_POST['descripcion']);
    
    //Get ID from users
    $id_usuario = $_SESSION['id_usuario']; 
    
    //Validates no empy fields
    if (empty($id_coche) || empty($tipo) || empty($descripcion)) {
        die("Error: Todos los campos son obligatorios.");
    }

    try {
        
        $sql = "INSERT INTO mantenimientos (id_coche, id_usuario, tipo, descripcion, fecha) VALUES (?, ?, ?, ?, NOW())";
        $stmt = $pdo->prepare($sql);
        //Send the 4 variables in order
        $stmt->execute([$id_coche, $id_usuario, $tipo, $descripcion]);


        header("Location: ../vistas/mantenimiento.php?status=success");
        exit();

    } catch (PDOException $e) {
        die("Error al registrar el mantenimiento: " . $e->getMessage());
    }
} else {
    header("Location: ../vistas/mantenimiento.php");
    exit();
}