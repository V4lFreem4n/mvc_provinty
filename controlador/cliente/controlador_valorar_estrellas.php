<?php
session_start();
include_once '../../autoload.php'; // Asegúrate de que esto incluya los archivos correctamente

header('Content-Type: application/json');

// Obtener el cuerpo de la solicitud y decodificar el JSON
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// Verificar si se recibieron datos correctamente
if ($data) {
    // Obtener los datos del JSON
    $estrellas = $data['estrellas']; 
    $id_cliente = $data['id_cliente'];
    $id_evento = $data['id_evento'];

    // Aquí, puedes hacer la lógica para insertar estos datos en la base de datos
    $conn = new Database();
    $db = $conn->connect();
    //$cliente = new Cliente($db);
    $interaccion_estrellas = new InteracconesEstrellas($db);
    $interaccion_estrellas->actualizarOcrearInteraccion($estrellas,$id_cliente,$id_evento);
    
    // Por ejemplo, insertar los datos en la base de datos, solo como un ejemplo:
    // $resultado = $cliente->insertarEstrellas($id_cliente, $id_evento, $estrellas);
    
    // Si la inserción fue exitosa, responde con el JSON adecuado
    echo json_encode([
        'status' => 'success',
        'message' => 'Datos recibidos correctamente',
        'data' => $data // Devuelves los mismos datos como respuesta
    ]);
} else {
    // Responder con un error si no se pudo decodificar
    echo json_encode([
        'status' => 'error',
        'message' => 'No se recibieron datos válidos'
    ]);
}
?>
