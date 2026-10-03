<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //get and trim all data extracted from the form
    $placa = strtoupper(trim($_POST['placa'])); 
    $marca_modelo = trim($_POST['marca_modelo']);
    $nombre_vehiculo = trim($_POST['nombre_vehiculo']);
    $combustible = $_POST['combustible'];
    $ejes = intval($_POST['ejes']);
    $anio = intval($_POST['anio']);
    $tipo_vehiculo = trim($_POST['tipo_vehiculo']);
    
    //Process Image first
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $permitidos = ['jpg', 'jpeg', 'png', 'webp'];
        $nombre_archivo = $_FILES['foto']['name'];
        $extension = strtolower(pathinfo($nombre_archivo, PATHINFO_EXTENSION));
        
        if (in_array($extension, $permitidos)) {
            //creates unique name for the file
            $nuevo_nombre = "coche_" . $placa . "_" . time() . "." . $extension;
            $ruta_destino = "../uploads/" . $nuevo_nombre;
            
            //Move temp file to uploads folder
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $ruta_destino)) {
                
                
                //route for the BD views
                $ruta_db = "uploads/" . $nuevo_nombre;
                
                try {

                    $sql = "INSERT INTO coches (placa, marca_modelo, nombre_vehiculo, combustible, ejes, anio, tipo_vehiculo, foto_ruta, estado) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'en_parking')";
                    
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([
                        $placa, 
                        $marca_modelo, 
                        $nombre_vehiculo, 
                        $combustible, 
                        $ejes, 
                        $anio, 
                        $tipo_vehiculo, 
                        $ruta_db
                    ]);
                
                    //Redirect to dashboard
                    header("Location: ../vistas/parking.php?mensaje=alta_exitosa");
                    exit();

                } catch (PDOException $e) {
                    die("Error al guardar en la base de datos: " . $e->getMessage());
                }

            } else {
                echo "Error al mover el archivo a la carpeta de destino. ¿Existe la carpeta uploads?";
            }
        } else {
            echo "Formato de imagen no permitido.";
        }
    } else {
        echo "Debes subir una foto del vehículo.";
    }
}
?>