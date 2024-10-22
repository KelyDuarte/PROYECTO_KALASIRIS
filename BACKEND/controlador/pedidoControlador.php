<?php
header ("Access-Control-Allow-Origin: *");
header ("Access-Control-Allow-Methods: POST, DELETE, OPTIONS");
header ("Access-Control-Allow-Headers: Content-Type, origin");
header ("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require "../modelo/conexion.php";

$datos = json_decode(file_get_contents("php://input"),true);
print_r($datos);

//INSERTAR
function insertarPedido($pdo, $idcliente, $idproducto){
    $sql = "INSERT INTO `pedido`(`idpedido`, `idcliente`, `idproducto`) VALUES (:valor1, :valor2, :valor3)";
    $preparacion = $pdo->prepare($sql);
    $preparacion->bindParam(':valor1', $idpedido, PDO::PARAM_INT);
    $preparacion->bindParam(':valor2', $idcliente, PDO::PARAM_INT);
    $preparacion->bindParam(':valor3', $idproducto, PDO::PARAM_INT);
    $preparacion->execute();
    echo "Datos insertados correctamente";
}

//ACTUALIZAR
function actualizarPedido($pdo, $idpedido, $idcliente, $idproducto){
    $sql = "UPDATE `pedido` SET `idcliente`=:valor2,`idproducto`=:valor3 WHERE idpedido=:valor1";
    $preparacion = $pdo->prepare($sql);
    $preparacion->bindParam(':valor1', $idpedido, PDO::PARAM_INT);
    $preparacion->bindParam(':valor2', $idcliente, PDO::PARAM_INT);
    $preparacion->bindParam(':valor3', $idproducto, PDO::PARAM_INT);
    $preparacion->execute();
    echo "Datos actualizados correctamente";
}

//SELECCIONAR
function seleccionarPedido($pdo){
    $sql = "SELECT * FROM `pedido`";
    $preparacion = $pdo->prepare($sql);
    $preparacion->execute();
    $datos = $preparacion->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($datos);
}
seleccionarPedido($pdo);

//ELIMINAR
function eliminarPedido($pdo, $idpedido){
    $sql = "DELETE FROM `pedido` WHERE idpedido=:valor1";
    $preparacion = $pdo->prepare($sql);
    $preparacion->bindParam(':valor1', $idpedido, PDO::PARAM_INT);
    $preparacion->execute();
    echo "Dato eliminado correctamente";
}

//PROCESAR SOLICITUDES POST
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($datos['accion'])){
        switch ($datos['accion']){
            case 'insertar':
                insertarPedido($pdo, $datos ['idcliente'], $datos ['idproducto']);
                break;
            case 'actualizar':
                actualizarPedido($pdo, $datos ['idpedido'], $datos ['idcliente'], $datos ['idproducto']);
                break;
            case 'eliminar':
                eliminarPedido($pdo, $datos ['idpedido']); 
                break;
    }   
  }
}

//PROCESAR SOLICITUDES GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['accion']) && $_GET['accion'] == 'seleccionar') {
        $pedido = seleccionarPedido($pdo);
        echo json_encode($datos);
    }
}
?>