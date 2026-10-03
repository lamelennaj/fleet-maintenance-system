<?php
session_start();
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['username']);
    $pass = trim($_POST['password']);

    if (empty($user) || empty($pass)) {
        header("Location: ../vistas/login.php?error=" . urlencode("Todos los campos son obligatorios"));
        exit();
    }

    try {
        //Search user in database
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE username = :username LIMIT 1" );
        $stmt->execute(['username' => $user]);
        $usuario = $stmt->fetch();

        if ($usuario) {
            if ($pass === $usuario['password']) {
                
                //Save session data
                $_SESSION['id_usuario'] = $usuario['id_usuario'];
                $_SESSION['usuario']    = $usuario['username'];
                $_SESSION['rol']        = $usuario['rol'];

                //return to dashboard if you logged in succesfully
                header("Location: ../vistas/parking.php");
                exit();
            }
        }


        header("Location: ../vistas/login.php?error=" . urlencode("Usuario o contraseña incorrectos"));
        exit();

    } catch (PDOException $e) {
        //error log for the developer to read
        header("Location: ../vistas/login.php?error=" . urlencode("Error de conexión: " . $e->getMessage()));
        exit();
    }
} else {
    //Redirects if you try to access the file without using POST
    header("Location: ../vistas/login.php");
    exit();
}