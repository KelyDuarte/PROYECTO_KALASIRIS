<?php
header ("Access-Control-Allow-Origin: *");
header ("Access-Control-Allow-Methods: POST, DELETE, OPTIONS");
header ("Access-Control-Allow-Headers: Content-Type, origin");
header ("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require "../modelo/conexion.php";

$datos = json_decode(file_get_contents("php://input"),true);
print_r($datos);

//INSERTAR
function insertarVenta($pdo, $idpedido, $fecha_pago, $fecha_entrega, $total_venta){
    $sql = "INSERT INTO `venta`(`idpedido`, `fecha_pago`, `fecha_entrega`, `total_venta`) 
    VALUES (:valor1, :valor2, :valor3, :valor4, :valor5)";
    $preparacion = $pdo->prepare($sql);
    $preparacion->bindParam(':valor1', $idventa, PDO::PARAM_INT);
    $preparacion->bindParam(':valor2', $idpedido, PDO::PARAM_INT);
    $preparacion->bindParam(':valor3', $fecha_pago, PDO::PARAM_STR);
    $preparacion->bindParam(':valor4', $fecha_entrega, PDO::PARAM_STR);
    $preparacion->bindParam(':valor5', $total_venta, PDO::PARAM_STR);
    $preparacion->execute();
    echo "Datos insertados correctamente";
}

//ACTUALIZAR
function actualizarVenta($pdo, $idventa, $idpedido, $fecha_pago, $fecha_entrega, $total_venta){
    $sql = "UPDATE `venta` SET `idpedido`=:valor2,`fecha_pago`=:valor3,`fecha_entrega`=:valor4,`total_venta`=:valor5 WHERE idventa=:valor1";
    $preparacion = $pdo->prepare($sql);
    $preparacion->bindParam(':valor1', $idventa, PDO::PARAM_INT);
    $preparacion->bindParam(':valor2', $idpedido, PDO::PARAM_INT);
    $preparacion->bindParam(':valor3', $fecha_pago, PDO::PARAM_STR);
    $preparacion->bindParam(':valor4', $fecha_entrega, PDO::PARAM_STR);
    $preparacion->bindParam(':valor5', $total_venta, PDO::PARAM_STR);
    $preparacion->execute();
    echo "Datos actualizados correctamente";
}

//SELECCIONAR
function seleccionarVenta($pdo){
    $sql = "SELECT * FROM `venta`";
    $preparacion = $pdo->prepare($sql);
    $preparacion->execute();
    $datos = $preparacion->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($datos);
}
seleccionarVenta($pdo);

//ELIMINAR
function eliminarVenta($pdo, $idventa){
    $sql = "DELETE FROM `venta` WHERE idventa=:valor1";
    $preparacion = $pdo->prepare($sql);
    $preparacion->bindParam(':valor1', $idventa, PDO::PARAM_INT);
    $preparacion->execute();
    echo "Dato eliminado correctamente";
}

//PROCESAR SOLICITUDES POST
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($datos['accion'])){
        switch ($datos['accion']){
            case 'insertar':
                insertarVenta($pdo, $datos ['idpedido'], $datos ['fecha_pago'], $datos ['fehca_entrega'], $datos ['total_venta']);
                break;
            case 'actualizar':
                actualizarVenta($pdo, $datos ['idventa'], $datos ['idpedido'], $datos ['fecha_pago'], $datos ['fehca_entrega'], $datos ['total_venta']);
                break;
            case 'eliminar':
                eliminarVenta($pdo, $datos ['idventa']); 
                break;
    }   
  }
}

//PROCESAR SOLICITUDES GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['accion']) && $_GET['accion'] == 'seleccionar') {
        $venta = seleccionarVenta($pdo);
        echo json_encode($datos);
    }
}
?>