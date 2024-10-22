<?php
header ("Access-Control-Allow-Origin: *");
header ("Access-Control-Allow-Methods: POST, DELETE, OPTIONS");
header ("Access-Control-Allow-Headers: Content-Type, origin");
header ("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require "../modelo/conexion.php";

$datos = json_decode(file_get_contents("php://input"),true);
print_r($datos);

//INSERTAR
function insertarAdministrativo($pdo, $nombre, $documento, $direccion, $correo, $telefono, $cargo){
    $sql = "INSERT INTO `administrativo`(`idadministrativo`, `nombre`, `documento`, `dirección`, `correo`, `telefono`, `cargo`) 
    VALUES (:valor1, :valor2, :valor3, :valor4, :valor5, :valor6, :valor7)";
    $preparacion = $pdo->prepare($sql);
    $preparacion->bindParam(':valor1', $idadministrativo, PDO::PARAM_INT);
    $preparacion->bindParam(':valor2', $nombre, PDO::PARAM_STR);
    $preparacion->bindParam(':valor3', $documento, PDO::PARAM_INT);
    $preparacion->bindParam(':valor4', $direccion, PDO::PARAM_STR);
    $preparacion->bindParam(':valor5', $correo, PDO::PARAM_STR);
    $preparacion->bindParam(':valor6', $telefono, PDO::PARAM_INT);
    $preparacion->bindParam(':valor7', $cargo, PDO::PARAM_STR);
    $preparacion->execute();
echo "Datos insertados correctamente";
}

//ACTUALIZAR
function actualizarAdministrativo($pdo, $idadministrativo, $nombre, $documento, $direccion, $correo, $telefono, $cargo){
    $sql = "UPDATE `administrativo` SET `nombre`=:valor2,`documento`=:valor3,`dirección`=:valor4,`correo`=:valor5,`telefono`=:valor6,`cargo`=:valor7
    WHERE idadministrativo=:valor1";
    $preparacion = $pdo->prepare($sql);
    $preparacion->bindParam(':valor1', $idadministrativo, PDO::PARAM_INT);
    $preparacion->bindParam(':valor2', $nombre, PDO::PARAM_STR);
    $preparacion->bindParam(':valor3', $documento, PDO::PARAM_INT);
    $preparacion->bindParam(':valor4', $direccion, PDO::PARAM_STR);
    $preparacion->bindParam(':valor5', $correo, PDO::PARAM_STR);
    $preparacion->bindParam(':valor6', $telefono, PDO::PARAM_INT);
    $preparacion->bindParam(':valor7', $cargo, PDO::PARAM_STR);
    $preparacion->execute();
    echo "Datos actualizados correctamente";
}

//SELECCIONAR
function seleccionarAdministrativo($pdo){
    $sql = "SELECT * FROM `administrativo`";
    $preparacion = $pdo->prepare($sql);
    $preparacion->execute();
    $datos = $preparacion->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($datos);
}
seleccionarAdministrativo($pdo);

//ELIMINAR 
function eliminarAdministrativo ($pdo, $idadministrativo){
    $sql = "DELETE FROM `administrativo` WHERE idadministrativo=:valor1";
    $preparacion = $pdo->prepare($sql);
    $preparacion->bindParam(':valor1', $idadministrativo, PDO::PARAM_INT);
    $preparacion->execute();
    echo "Dato eliminado correctamente";
}

//PROCESAR SOLICITUDES POST
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($datos['accion'])){
        switch ($datos['accion']){
            case 'insertar':
                insertarAdministrativo($pdo, $datos ['nombre'], intval ($datos ['documento']), $datos ['direccion'], $datos ['correo'], $datos ['telefono'], $datos ['cargo']);
                break;
            case 'actualizar':
                actualizarAdministrativo($pdo, $datos ['idadministrativo'], $datos ['nombre'], intval ($datos ['documento']), $datos ['direccion'], $datos ['correo'], $datos ['telefono'], $datos ['cargo']);
                break;
            case 'eliminar':
                eliminarAdministrativo($pdo, $datos ['idadministrativo']); 
                break;
    }   
  }
}

//PROCESAR SOLICITUDES GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['accion']) && $_GET['accion'] == 'seleccionar') {
        $administrativo = seleccionarAdministrativo($pdo);
        echo json_encode($datos);
    }
}
?>