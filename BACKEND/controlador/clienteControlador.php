<?php
header ("Access-Control-Allow-Origin: *");
header ("Access-Control-Allow-Methods: POST, DELETE, OPTIONS");
header ("Access-Control-Allow-Headers: Content-Type, origin");
header ("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require "../modelo/conexion.php";

$datos = json_decode(file_get_contents("php://input"),true);

//INSERTAR 
function insertarCliente($pdo, $nombre, $documento, $direccion, $telefono, $correo, $contrasena){
    $sql = "INSERT INTO `cliente`(`nombre`, `documento`, `direccion`, `telefono`, `correo`, `contrasena`) 
    VALUES (:valor1,:valor2,:valor3,:valor4,:valor5,:valor6)";
    $preparacion = $pdo->prepare($sql);
    $preparacion->bindParam(':valor1', $nombre, PDO::PARAM_STR);
    $preparacion->bindParam(':valor2', $documento, PDO::PARAM_INT);
    $preparacion->bindParam(':valor3', $direccion, PDO::PARAM_STR);
    $preparacion->bindParam(':valor4', $telefono, PDO::PARAM_INT);
    $preparacion->bindParam(':valor5', $correo, PDO::PARAM_STR);
    $preparacion->bindParam(':valor6', $contrasena, PDO::PARAM_STR);
    $preparacion->execute();
    $respuesta = [
        'estado'=> true,
        'mensaje'=>"Datos insertados correctamente"];
    echo json_encode($respuesta);
}

//ACTUALIZAR
function actualizarCliente($pdo, $idcliente, $nombre, $documento, $direccion, $telefono, $correo, $contrasena){
    $sql = "UPDATE `cliente` SET `nombre`=:valor2,`documento`=:valor3,`direccion`=:valor4,`telefono`=:valor5,`correo`=:valor6, 'contrasena'=:valor7
    WHERE idcliente=:valor1"; 
    $preparacion = $pdo->prepare($sql);
    $preparacion->bindParam(':valor1', $idcliente, PDO::PARAM_INT);
    $preparacion->bindParam(':valor2', $nombre, PDO::PARAM_STR);
    $preparacion->bindParam(':valor3', $documento, PDO::PARAM_INT);
    $preparacion->bindParam(':valor4', $direccion, PDO::PARAM_STR);
    $preparacion->bindParam(':valor5', $telefono, PDO::PARAM_INT);
    $preparacion->bindParam(':valor6', $correo, PDO::PARAM_STR);
    $preparacion->bindParam(':valor7', $contrasena, PDO::PARAM_STR);
    $preparacion->execute();
    echo "Datos actualizados correctamente";
}

function login($pdo,$correo,$contrasena){
    $sql = "SELECT * FROM `cliente` WHERE correo = :valor1 and contrasena= :valor2";
    $preparacion = $pdo->prepare($sql);
    $preparacion->bindParam(':valor1', $correo, PDO::PARAM_STR);
    $preparacion->bindParam(':valor2', $contrasena, PDO::PARAM_STR);
    $preparacion->execute();
    
    if($datos = $preparacion->fetchAll(PDO::FETCH_ASSOC)){
        $respuesta = [
            'conectado'=> true];
        echo json_encode($respuesta);
    }else{
        $respuesta = [
            'conectado'=> false,
        'error' => 'La clave o contraseña es incorrecta, vuelva a intentarlo.'];
            echo json_encode($respuesta);
    }
}
   
//SELECCIONAR
function seleccionarCliente($pdo){
    $sql = "SELECT * FROM `cliente`";
    $preparacion = $pdo->prepare($sql);
    $preparacion->execute();
    $datos = $preparacion->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($datos);
}

//ELIMINAR 
function eliminarCliente($pdo, $idcliente){
    $sql = "DELETE FROM `cliente` WHERE idcliente=:valor1";
    $preparacion = $pdo->prepare($sql);
    $preparacion->bindParam(':valor1', $idcliente, PDO::PARAM_INT);
    $preparacion->execute();
    echo "Dato eliminado correctamente";
}

//PROCESAR SOLICITUDES POST
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($datos['accion'])){
        switch ($datos['accion']){
            case 'insertar':
                insertarCliente($pdo, $datos['nombre'], $datos['documento'], $datos['direccion'], $datos['telefono'], $datos['correo'], $datos['contrasena']);
                break;
            case 'actualizar':
                actualizarCliente($pdo, $datos ['idcliente'], $datos ['nombre'], $datos ['documento'], $datos ['direccion'], $datos ['telefono'],  $datos ['correo'], $datos ['contrasena']);
                break;
            case 'login':
                login($pdo, $datos['correo'], $datos['contrasena']); 
                break;
            case 'eliminar':
                eliminarCliente($pdo, $datos ['idcliente']); 
                break;
    }   
  }
}

//PROCESAR SOLICITUDES GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ( $_GET['accion'] == 'seleccionar') {
        $cliente = seleccionarCliente($pdo);
        echo json_encode($cliente);
    }
}
?>