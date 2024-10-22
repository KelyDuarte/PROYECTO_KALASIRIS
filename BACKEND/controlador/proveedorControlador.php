<?php
header ("Access-Control-Allow-Origin: *");
header ("Access-Control-Allow-Methods: POST, DELETE, OPTIONS");
header ("Access-Control-Allow-Headers: Content-Type, origin");
header ("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require "../modelo/conexion.php";

$datos = json_decode(file_get_contents("php://input"),true);
print_r($datos);

//INSERTAR
function insertarProveedor($pdo, $nit, $nombre_proveedor, $telefono, $direccion){
    $sql = "INSERT INTO `proveedor`(`idproveedor`, `nit`, `nombre_proveedor`, `telefono`, `direccion`) 
    VALUES (:valor1, :valor2, :valor3, :valor4, :valor5)";
    $preparacion = $pdo->prepare($sql);
    $preparacion->bindParam(':valor1', $idproveedor, PDO::PARAM_INT);
    $preparacion->bindParam(':valor2', $nit, PDO::PARAM_STR);
    $preparacion->bindParam(':valor3', $nombre_proveedor, PDO::PARAM_STR);
    $preparacion->bindParam(':valor4', $telefono, PDO::PARAM_INT);
    $preparacion->bindParam(':valor5', $direccion, PDO::PARAM_STR);
    $preparacion->execute();
    echo "Datos insertados correctamente";
}

//ACTUALIZAR
function actualizarProveedor($pdo, $idproveedor, $nit, $nombre_proveedor, $telefono, $direccion){
    $sql = "UPDATE `proveedor` SET `nit`=:valor2,`nombre_proveedor`=:valor3,`telefono`=:valor4,`direccion`=:valor5 WHERE idproveedor=:valor1";
    $preparacion = $pdo->prepare($sql);
    $preparacion->bindParam(':valor1', $idproveedor, PDO::PARAM_INT);
    $preparacion->bindParam(':valor2', $nit, PDO::PARAM_STR);
    $preparacion->bindParam(':valor3', $nombre_proveedor, PDO::PARAM_SRT);
    $preparacion->bindParam(':valor4', $telefono, PDO::PARAM_INT);
    $preparacion->bindParam(':valor5', $direccion, PDO::PARAM_STR);
    $preparacion->execute();
    echo "Datos actualizados correctamente";
}

//SELECCIONAR
function seleccionarProveedor($pdo){
    $sql = "SELECT * FROM `proveedor`";
    $preparacion = $pdo->prepare($sql);
    $preparacion->execute();
    $datos = $preparacion->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($datos);
}
seleccionarProveedor($pdo);

//ELIMINAR
function eliminarProveedor($pdo, $idproveedor){
    $sql = "DELETE FROM `proveedor` WHERE idproveedor=:valor1";
    $preparacion = $pdo->prepare($sql);
    $preparacion->bindParam(':valor1', $idproveedor, PDO::PARAM_INT);
    $preparacion->execute();
    echo "Dato eliminado correctamente";
}

//PROCESAR SOLICITUDES POST
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($datos['accion'])){
        switch ($datos['accion']){
            case 'insertar':
                insertarProveedor($pdo, $datos ['nit'], $datos ['nombre_proveedor'], $datos ['telefono'], $datos ['direccion']);
                break;
            case 'actualizar':
                actualizarProveedor($pdo, $datos ['idproveedor'], $datos ['nit'], $datos ['nombre_proveedor'], $datos ['telefono'], $datos ['direccion']);
                break;
            case 'eliminar':
                eliminarProveedor($pdo, $datos ['idproveedor']); 
                break;
    }   
  }
}

//PROCESAR SOLICITUDES GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['accion']) && $_GET['accion'] == 'seleccionar') {
        $proveedor = seleccionarProveedor($pdo);
        echo json_encode($proveedor);
    }
}
?>