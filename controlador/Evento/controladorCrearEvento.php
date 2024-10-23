<?php
include_once '../../autoload.php';

$input = file_get_contents('php://input');
$datosEvento = json_decode($input, true);

$conn = new Database();
$evento = new Evento($conn->connect());


if ($datosEvento) {

    $id = $datosEvento['id'];
    $nombre = $datosEvento['nombre'];
    $fecha = $datosEvento['fecha'];
    $categoria = $datosEvento['categoria'];
    $ubicacion = $datosEvento['ubicacion'];
    $horaInicio = $datosEvento['horaInicio'];
    $horaFin = $datosEvento['horaFin'];
    $capacidad = $datosEvento['capacidad'];
    $organizador = $datosEvento['organizador'];
    $contactoOrganizador = $datosEvento['contactoOrganizador'];
    $redes = $datosEvento['redes'];
    $politicaCancelacion = $datosEvento['politicaCancelacion'];
    $descripcion = $datosEvento['descripcion'];
    $imagen = $datosEvento['imagen'];

    $evento->crearEvento($nombre,$capacidad,10,100,"imagen",$descripcion,$organizador,$fecha,$fecha,"Borrador");

    echo json_encode(["status" => "success", "message" => "Se creó el evento"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error al recibir los datos."]);
}
?>
