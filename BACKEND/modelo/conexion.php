<?php

$host = "localhost";
$dbnombre = "kalasiris";
$usuario = "root";
$contrasena = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbnombre;charset=utf8", $usuario, $contrasena);
 
     /* // Modo de error de PDO para que lance excepciones
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // Mensaje para confirmar conexión
        echo "Conexión exitosa";
    } catch (PDOException $e) {
        // Manejar errores de conexión
        echo "Error en la conexión: " . $e->getMessage();
    } */
    
} catch (\Throwable $th){
    throw $th;
}

?>
