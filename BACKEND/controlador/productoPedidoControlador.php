<?php
header ("Access-Control-Allow-Origin: *");
header ("Access-Control-Allow-Methods: POST, DELETE, OPTIONS");
header ("Access-Control-Allow-Headers: Content-Type, origin");
header ("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require "../modelo/conexion.php";

$datos = json_decode(file_get_contents("php://input"),true);
print_r($datos);

//INSERTAR
function insertarProductoPedido($pdo, $idpedido, $idproducto){
    $sql = "INSERT INTO `producto_pedido`(`idproducto_pedido`, `idpedido`, `idproducto`) 
    VALUES (:valor1, :valor2, :valor3)";
    $preparacion = $pdo->prepare($sql);
    $preparacion->bindParam(':valor1', $idproducto_pedido, PDO::PARAM_INT);
    $preparacion->bindParam(':valor2', $idpedido, PDO::PARAM_INT);
    $preparacion->bindParam(':valor3', $idproducto, PDO::PARAM_INT);
    $preparacion->execute();
    echo "Datos insertados correctamente";
}

//ACTUALIZAR
function actualizarProductoPedido($pdo, $idproducto_pedido, $idpedido, $idproducto){
    $sql = "UPDATE `producto_pedido` SET `idpedido`=:valor2,`idproducto`=:valor3 WHERE idproducto_pedido=:valor1";
    $preparacion = $pdo->prepare($sql);
    $preparacion->bindParam(':valor1', $idproducto_pedido, PDO::PARAM_INT);
    $preparacion->bindParam(':valor2', $idpedido, PDO::PARAM_INT);
    $preparacion->bindParam(':valor3', $idproducto, PDO::PARAM_INT);
    $preparacion->execute();
    echo "Datos actualizados correctamente";
}

//SELECCIONAR
function seleccionarProductoPedido($pdo){
    $sql = "SELECT * FROM `producto_pedido`";
    $preparacion = $pdo->prepare($sql);
    $preparacion->execute();
    $datos = $preparacion->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($datos);
}
seleccionarProductoPedido($pdo);

//ELIMINAR
function eliminarProductoPedido($pdo, $idproducto_pedido){  
    $sql = "DELETE FROM `producto_pedido` WHERE idproducto_pedido=:valor1";
    $preparacion = $pdo->prepare($sql);
    $preparacion->bindParam(':valor1', $idproducto_pedido, PDO::PARAM_INT);
    $preparacion->execute();
    echo "Dato eliminado correctamente";
}

//PROCESAR SOLICITUDES POST
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($datos['accion'])){
        switch ($datos['accion']){
            case 'insertar':
                insertarProductoPedido($pdo, $datos ['idcliente'], $datos ['idproducto']);
                break;
            case 'actualizar':
                actualizarProductoPedido($pdo, $datos ['idproducto_pedido'], $datos ['idcliente'], $datos ['idproducto']);
                break;
            case 'eliminar':
                eliminarProductoPedido($pdo, $datos ['idproducto_pedido']); 
                break;
    }   
  }
}

//PROCESAR SOLICITUDES GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['accion']) && $_GET['accion'] == 'seleccionar') {
        $producto_pedido = seleccionarProductoPedido($pdo);
        echo json_encode($datos);
    }
}
?>