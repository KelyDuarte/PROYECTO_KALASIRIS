<?php
header ("Access-Control-Allow-Origin: *");
header ("Access-Control-Allow-Methods: POST, DELETE, OPTIONS");
header ("Access-Control-Allow-Headers: Content-Type, origin");
header ("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require "../modelo/conexion.php";

$datos = json_decode(file_get_contents("php://input"),true);
print_r($datos);

//INSERTAR
function insertarProducto($pdo, $nombre_producto, $precio, $idcategoria, $cantidad, $idproveedor){
    $sql = "INSERT INTO `producto`(`idproducto`, `nombre_producto`, `precio`, `idcategoria`, `cantidad`, `idproveedor`) 
    VALUES (:valor1, :valor2, :valor3, :valor4, :valor5, :valor6)";
    $preparacion = $pdo->prepare($sql);
    $preparacion->bindParam(':valor1', $idproducto, PDO::PARAM_INT);
    $preparacion->bindParam(':valor2', $nombre_producto, PDO::PARAM_STR);
    $preparacion->bindParam(':valor3', $precio, PDO::PARAM_INT);
    $preparacion->bindParam(':valor4', $idcategoria, PDO::PARAM_INT);
    $preparacion->bindParam(':valor5', $cantidad, PDO::PARAM_INT);
    $preparacion->bindParam(':valor6', $idproveedor, PDO::PARAM_INT);
    $preparacion->execute();
    echo "Datos insertados correctamente";
}

//ACTUALIZAR
function actualizarProducto($pdo, $idproducto, $nombre_producto, $precio, $idcategoria, $cantidad, $idproveedor){
    $sql = "UPDATE `producto` SET `nombre_producto`=:valor2,`precio`=:valor3,`idcategoria`=:valor4,`cantidad`=:valor5,`idproveedor`=:valor6 
    WHERE idproducto=:valor1";
    $preparacion = $pdo->prepare($sql);
    $preparacion->bindParam(':valor1', $idproducto, PDO::PARAM_INT);
    $preparacion->bindParam(':valor2', $nombre_producto, PDO::PARAM_STR);
    $preparacion->bindParam(':valor3', $precio, PDO::PARAM_INT);
    $preparacion->bindParam(':valor4', $idcategoria, PDO::PARAM_INT);
    $preparacion->bindParam(':valor5', $cantidad, PDO::PARAM_INT);
    $preparacion->bindParam(':valor6', $idproveedor, PDO::PARAM_INT);
    $preparacion->execute();
    echo "Datos actualizados correctamente";
}

//SELECCIONAR
function seleccionarProducto($pdo){
    $sql = "SELECT * FROM `producto`";
    $preparacion = $pdo->prepare($sql);
    $preparacion->execute();
    $datos = $preparacion->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($datos);
}
seleccionarProducto($pdo);

//ELIMINAR
function eliminarProducto($pdo, $idproducto){
    $sql = "DELETE FROM `producto` WHERE idproducto=:valor1";
    $preparacion = $pdo->prepare($sql);
    $preparacion->bindParam(':valor1', $idproducto, PDO::PARAM_INT);
    $preparacion->execute();
    echo "Dato eliminado correctamente";
}

//PROCESAR SOLICITUDES POST
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($datos['accion'])){
        switch ($datos['accion']){
            case 'insertar':
                insertarProducto($pdo, $datos ['nombre_producto'], $datos ['precio'], $datos ['idcategoria'], $datos ['cantidad'], $datos ['idproveedor']);
                break;
            case 'actualizar':
                actualizarProducto($pdo, $datos ['idproducto'], $datos ['nombre_producto'], $datos ['precio'], $datos ['idcategoria'], $datos ['cantidad'], $datos ['idproveedor']);
                break;
            case 'eliminar':
                eliminarProducto($pdo, $datos ['idproducto']); 
                break;
    }   
  }
}

//PROCESAR SOLICITUDES GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['accion']) && $_GET['accion'] == 'seleccionar') {
        $producto = seleccionarProducto($pdo);
        echo json_encode($datos);
    }
}
?>