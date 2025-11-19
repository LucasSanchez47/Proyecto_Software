<?php
session_start();
require_once "Entradas_model.php";
require_once "Entrada.php";

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success'=>false,'error'=>'Método no permitido']);
    exit;
}

if (!isset($_SESSION['idUsuario'])) {
    http_response_code(403);
    echo json_encode(['success'=>false,'error'=>'Debes iniciar sesión']);
    exit;
}

$ID_Funcion = filter_input(INPUT_POST, 'ID_Funcion', FILTER_VALIDATE_INT);
$ID_Asiento = filter_input(INPUT_POST, 'ID_Asiento', FILTER_VALIDATE_INT);

if (!$ID_Funcion || !$ID_Asiento) {
    http_response_code(400);
    echo json_encode(['success'=>false,'error'=>'Datos inválidos']);
    exit;
}

$entrada = new Entrada();
$entrada->setFecha(date('Y-m-d'));
$entrada->setIDFuncion($ID_Funcion);
$entrada->setIDAsiento($ID_Asiento);
$entrada->setIdUsuario($_SESSION['idUsuario']);

$model = new EntradasModel();

try {
    $id = $model->Registrar($entrada);
    echo json_encode(['success' => true, 'idEntrada' => $id]);
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
