<?php
include_once '../../autoload.php';


$jsonData = file_get_contents('php://input');

$data = json_decode($jsonData, true);

$conn = new Database();

$crear = $data['crear']; //Trabajamos con esta variable


if($crear){

$eventos = new Evento($conn->connect());

    $response = [
        'status' => 'success',
        'message' => 'Datos recibidos correctamente',
        'data' => $data,
        'eventos' => $eventos->mostrarEventos()
    ];
}else{
    $response = [
        'status' => '404',
        'message' => 'Datos NO recibidos correctamente',
        'data' => $data
    ];
}



header('Content-Type: application/json');
echo json_encode($response);



?>