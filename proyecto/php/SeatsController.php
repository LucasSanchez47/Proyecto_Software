<?php
require_once "Funciones_model.php";
require_once "Asiento_model.php";
require_once "Entradas_model.php";

header('Content-Type: application/json; charset=utf-8');

if (!isset($_GET['ID_Funcion'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Falta ID_Funcion']);
    exit;
}

$ID_Funcion = (int)$_GET['ID_Funcion'];

$fm = new FuncionModel();
$func = $fm->Obtener($ID_Funcion);
if (!$func) {
    http_response_code(404);
    echo json_encode(['error' => 'Función no encontrada']);
    exit;
}
$ID_Sala = $func->getIDSala();

$asModel = new AsientoModel();
$asientos = $asModel->ListarPorSala($ID_Sala);

$entradasModel = new EntradasModel();
$ocupados = $entradasModel->AsientosOcupadosPorFuncion($ID_Funcion);

$out = [
    'funcion' => [
        'ID_Funcion' => $ID_Funcion,
        'ID_Sala' => $ID_Sala,
        'precio' => $func->getPrecio()
    ],
    'asientos' => [],
    'ocupados' => $ocupados
];

foreach ($asientos as $a) {
    $out['asientos'][] = [
        'ID_Asiento' => $a->getIDAsiento(),
        'fila' => $a->getFila(),
        'numero' => $a->getNumero(),
        'etiqueta' => $a->getEtiqueta()
    ];
}

echo json_encode($out);
