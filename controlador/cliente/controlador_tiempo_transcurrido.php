<?php
try {
    // Código principal
    session_start();
    include_once '../../autoload.php';
    header('Content-Type: application/json');

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if ($data) {
        
        $id_cliente = intval($data['id_cliente']);
        $id_evento = intval($data['id_evento']);

        $conn = new Database();
        $tiempoModelo = new Interaccion($conn->connect());
        $tiempoModelo->crearTiempoTranscurrido(3,$id_cliente, $id_evento); //El 3 es porque los datos se envían cada 3 segundos
        
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
