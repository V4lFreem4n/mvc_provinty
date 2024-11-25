<?php
try {
    // Código principal
    session_start();
    include_once '../../autoload.php';
    header('Content-Type: application/json');

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if ($data) {
        $estrellas = intval($data['estrellas']);
        $id_cliente = intval($data['id_cliente']);
        $id_evento = intval($data['id_evento']);

        $conn = new Database();
        $db = $conn->connect();
        $interaccion_estrellas = new InteraccionesEstrellas($db);
        $interaccion_estrellas->actualizarOcrearInteraccion($estrellas, $id_cliente, $id_evento);

        echo json_encode([
            'status' => 'success',
            'message' => 'Operación realizada correctamente',
            'data' => $data
        ]);
    } else {
        throw new Exception('No se recibieron datos válidos.');
    }
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}

?>
