<?php

$host = 'localhost';
$port = '3307';
$db   = 'estacionamiento_db';
$user = 'root';

$charset = 'utf8mb4';

//Use all dynamic variables on DSN
$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
    
} catch (\PDOException $e) {
     die("Error de conexión a la Base de Datos: ");
}
?>