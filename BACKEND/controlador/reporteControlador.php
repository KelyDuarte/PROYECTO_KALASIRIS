<?php
header ("Access-Control-Allow-Origin: *");
header ("Access-Control-Allow-Methods: POST, DELETE, OPTIONS");
header ("Access-Control-Allow-Headers: Content-Type, origin");
header ("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require "../modelo/conexion.php";

$datos = json_decode(file_get_contents("php://input"),true);
print_r($datos);

//INSERTAR
function insertarReporte($pdo, $idventa, $fecha_reporte){
    $sql = "INSERT INTO `reporte`(`idreporte`, `idventa`, `fecha_reporte`) VALUES (:valor1, :valor2: :valor3)";
    $preparacion = $pdo->prepare($sql);
    $preparacion->bindParam(':valor1', $idreporte, PDO::PARAM_INT);
    $preparacion->bindParam(':valor2', $idventa, PDO::PARAM_INT);
    $preparacion->bindParam(':valor3', $fecha_reporte, PDO::PARAM_STR);
    $preparacion->execute();
    echo "Datos insertados correctamente";
}

//ACTUALIZAR
function actualizarReporte($pdo, $idreporte, $idventa, $fecha_reporte){
    $sql = "UPDATE `reporte` SET `idventa`=:valor2,`fecha_reporte`=:valor3 WHERE idreporte=:valor1";
    $preparacion = $pdo->prepare($sql);
    $preparacion->bindParam(':valor1', $idreporte, PDO::PARAM_INT);
    $preparacion->bindParam(':valor2', $idventa, PDO::PARAM_INT);
    $preparacion->bindParam(':valor3', $fecha_reporte, PDO::PARAM_STR);
    $preparacion->execute();
    echo "Datos actualizados correctamente";
}

//SELECCIONAR
function seleccionarReporte($pdo){
    $sql = "SELECT * FROM `reporte`";
    $preparacion = $pdo->prepare($sql);
    $preparacion->execute();
    $datos = $preparacion->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($datos);
}
seleccionarReporte($pdo);

//ELIMINAR
function eliminarReporte($pdo, $idreporte){
    $sql = "DELETE FROM `reporte` WHERE idreporte=:valor1";
    $preparacion = $pdo->prepare($sql);
    $preparacion->bindParam(':valor1', $idreporte, PDO::PARAM_INT);
    $preparacion->execute();
    echo "Dato eliminado correctamente";
}

//PROCESAR SOLICITUDES POST
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($datos['accion'])){
        switch ($datos['accion']){
            case 'insertar':
                insertarReporte($pdo, $datos ['idventa'], $datos ['fecha_reporte']);
                break;
            case 'actualizar':
                actualizarReporte($pdo, $datos ['idreporte'], $datos ['idventa'], $datos ['fecha_reporte']);
                break;
            case 'eliminar':
                eliminarReporte($pdo, $datos ['idreporte']); 
                break;
    }   
  }
}

//PROCESAR SOLICITUDES GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['accion']) && $_GET['accion'] == 'seleccionar') {
        $reporte = seleccionarReporte($pdo);
        echo json_encode($datos);
    }
}
?>
