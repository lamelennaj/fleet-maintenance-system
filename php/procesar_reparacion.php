<?php
session_start();
// validates if session exists and roll is not "mecanico_"
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] === 'mecanico_b') {
    header("Location: ../vistas/login.php");
    exit();
}

// Imports connection to database
require_once 'conexion.php';

//Process all data from POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_coche = $_POST['id_coche'];
    $falla = trim($_POST['falla']);
    $detalles = trim($_POST['detalles']);
    
    //Get ID from logged mechanical 
    $id_usuario = $_SESSION['id_usuario'];

    //validates if there's no empty fields
    if (empty($id_coche) || empty($falla) || empty($detalles)) {
        die("Error: Todos los campos del reporte de reparación son obligatorios.");
    }

    try {
    
        //Insert into "Reparaciones". Use of NOW() to log exact date and time
        $sql = "INSERT INTO reparaciones (id_coche, id_usuario, falla, detalles, fecha) VALUES (?, ?, ?, ?, NOW())";
        $stmt = $pdo->prepare($sql);

        
        $stmt->execute([$id_coche, $id_usuario, $falla, $detalles]);

        //Redirect succesfully back to "Reparaciones" form
        header("Location: ../vistas/reparacion.php?status=success");
        exit();

    } catch (PDOException $e) {
        //Show error message in screen in case something happens
        die("Error al registrar la reparación mayor: " . $e->getMessage());
    }
} else {
    //Return to form in case someone wants to access directly from URL
    header("Location: ../vistas/reparacion.php");
    exit();
}