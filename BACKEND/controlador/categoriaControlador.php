<?php
header ("Access-Control-Allow-Origin: *");
header ("Access-Control-Allow-Methods: POST, DELETE, OPTIONS");
header ("Access-Control-Allow-Headers: Content-Type, origin");
header ("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require "../modelo/conexion.php";

$datos = json_decode(file_get_contents("php://input"),true);
print_r($datos);

//INSERTAR
function insertarCategoria($pdo, $nombre_categoria){
    $sql = "INSERT INTO `categoria`(`idcategoria`, `nombre_categoria`) VALUES (:valor1, :valor2)";
    $preparacion = $pdo->prepare($sql);
    $preparacion->bindParam(':valor1', $idcategoria, PDO::PARAM_INT);
    $preparacion->bindParam(':valor2', $nombre_categoria, PDO::PARAM_STR);
    $preparacion->execute();
    echo "Datos insertados correctamente";
}

//ACTUALIZAR
function actualizarCategoria($pdo, $idcategoria, $nombre_categoria){
    $sql = "UPDATE `categoria` SET `nombre_categoria=:valor2 WHERE idcategoria=:valor1";
    $preparacion = $pdo->prepare($sql);
    $preparacion->bindParam(':valor1', $idcategoria, PDO::PARAM_INT);
    $preparacion->bindParam(':valor2', $nombre_categoria, PDO::PARAM_STR);
    $preparacion->execute();
    echo "Datos actualizados correctamente";
}

//SELECCIONAR
function seleccionarCategoria($pdo){
    $sql = "SELECT * FROM `categoria`";
    $preparacion = $pdo->prepare($sql);
    $preparacion->execute();
    $datos = $preparacion->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($datos);
}
seleccionarCategoria($pdo);

//ELIMINAR
function eliminiarCategoria($pdo, $idcategoria){
    $sql = "DELETE FROM `categoria` WHERE idcategoria=:valor1";
    $preparacion = $pdo->prepare($sql);
    $preparacion->bindParam(':valor1', $idcategoria, PDO::PARAM_INT);
    $preparacion->execute();
    echo "Dato eliminado correctamente";
}

//PROCESAR SOLICITUDES POST
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($datos['accion'])){
        switch ($datos['accion']){
            case 'insertar':
                insertarCategoria($pdo, $datos ['nombre_categoria']);
                break;
            case 'actualizar':
                actualizarCategoria($pdo, $datos ['idcategoria'], ($datos ['nombre_categoria']));
                break;
            case 'eliminar':
                eliminiarCategoria($pdo, $datos ['idcategoria']); 
                break;
    }   
  }
}

//PROCESAR SOLICITUDES GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['accion']) && $_GET['accion'] == 'seleccionar') {
        $categoria = seleccionarCategoria($pdo);
        echo json_encode($datos);
    }
}
?>