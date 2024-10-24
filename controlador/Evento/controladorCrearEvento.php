<?php
require_once "../../autoload.php";
$conn = new Database();
$evento = new Evento($conn->connect());


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar y limpiar los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $categoria = $_POST['categoria'];
    $ubicacion = $_POST['ubicacion'];
    $horaInicio = $_POST['horaInicio'];
    $horaFin = $_POST['horaFin'];
    $capacidad = $_POST['capacidad'];
    $organizador = $_POST['organizador'];
    $contactoOrganizador = $_POST['contactoOrganizador'];
    $redes = $_POST['redes'];
    $politicaCancelacion = $_POST['politicaCancelacion'];
    $descripcion = $_POST['descripcion'];
    $imagen = $_POST['imagen'];

    // Comprobar si todos los datos requeridos están presentes
    //if ($id && $nombre && $fecha && $categoria && $ubicacion && $horaInicio && $horaFin && $capacidad && $organizador && $contactoOrganizador && $descripcion && $imagen) {
        // Aquí iría la lógica para procesar los datos
        
        $evento->crearEvento($nombre,$capacidad,404,404,$imagen,$descripcion,$organizador,$fecha,$fecha,"Publicado");

        header("Location: ../../public/admin-crear-evento.php");
        exit();
    //}
} else {
    echo "Método no permitido.";
    header("Location: ../../public/admin-crear-evento.php");
        exit();
}

?>