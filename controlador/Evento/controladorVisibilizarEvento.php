<?php
include_once '../../autoload.php';

$input = file_get_contents('php://input');
$datosEvento = json_decode($input, true);

$conn = new Database();
$evento = new Evento($conn->connect());

//Acá vamos a hacer la consulta a la bd para que cambie el estado
if($datosEvento){

$estado = $datosEvento['estado'];
$id = $datosEvento['id'];

if($estado=="Público"){
    $evento->visibilizarEvento($id);
}

if($estado=="Privado"){
    $evento->ocultarEvento($id);
}
echo json_encode(["status" => "success", "message" => "Se cambió la visibilidad al evento"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error al recibir los datos."]);
}

?>