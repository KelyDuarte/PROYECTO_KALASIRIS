<?php
header ("Access-Control-Allow-Origin: *");
header ("Access-Control-Allow-Methods: POST, DELETE, OPTIONS");
header ("Access-Control-Allow-Headers: Content-Type, origin");
header ("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require "../modelo/conexion.php";

$datos = json_decode(file_get_contents("php://input"),true);
print_r($datos);

//INSERTAR
function insertarRoles($pdo, $idcliente, $idadministrativo){
    $sql = "INSERT INTO `roles`(`idcliente`, `idadministrativo`) VALUES (:valor1, :valor2, :valor3)";
    $preparacion = $pdo->prepare($sql);
    $preparacion->bindParam(':valor1', $idroles, PDO::PARAM_INT);
    $preparacion->bindParam(':valor2', $idcliente, PDO::PARAM_INT);
    $preparacion->bindParam(':valor3', $idadministrativo, PDO::PARAM_INT);
    $preparacion->execute();
    echo "Datos insertados correctamente";
}

//ACTUALIZAR
function actualizarRoles($pdo, $idroles, $idcliente, $idadministrativo){
    $sql = "UPDATE `roles` SET `idcliente`=:valor2,`idadministrativo`=:valor3 WHERE idroles=:valor1";
    $preparacion = $pdo->prepare($sql);
    $preparacion->bindParam(':valor1', $idroles, PDO::PARAM_INT);
    $preparacion->bindParam(':valor2', $idcliente, PDO::PARAM_INT);
    $preparacion->bindParam(':valor3', $idadministrativo, PDO::PARAM_INT);
    $preparacion->execute();
    echo "Datos actualizados correctamente";
}

//SELECCIONAR
function seleccionarRoles($pdo){
    $sql = "SELECT * FROM `roles`";
    $preparacion = $pdo->prepare($sql);
    $preparacion->execute();
    $datos = $preparacion->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($datos);
}
seleccionarRoles($pdo);

//ELIMINAR
function eliminarRoles($pdo, $idroles){
    $sql = "DELETE FROM `roles` WHERE idroles=:valor1";
    $preparacion = $pdo->prepare($sql);
    $preparacion->bindParam(':valor1', $idroles, PDO::PARAM_INT);
    $preparacion->execute();
    echo "Dato eliminado correctamente";
}

//PROCESAR SOLICITUDES POST
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($datos['accion'])){
        switch ($datos['accion']){
            case 'insertar':
                insertarRoles($pdo, $datos ['idcliente'], $datos ['idadministrativo']);
                break;
            case 'actualizar':
                actualizarRoles($pdo, $datos ['idroles'], $datos ['idcliente'], $datos ['idadministrativo']);
                break;
            case 'eliminar':
                eliminarRoles($pdo, $datos ['idroles']); 
                break;
    }   
  }
}

//PROCESAR SOLICITUDES GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['accion']) && $_GET['accion'] == 'seleccionar') {
        $roles = seleccionarRoles($pdo);
        echo json_encode($datos);
    }
}
?>
