<?php
require_once "../../autoload.php";
$conn = new Database();
$evento = new Evento($conn->connect());
$categoria_evento = new Categoria_evento($conn->connect());

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar y limpiar los datos del formulario
    //$id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $capacidad = $_POST['capacidad'];
    $imagen = $_POST['imagen'];
    
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha'];
    //Vamos a crear la fecha del evento
    ///Vamos a crear la fecha de creación del evento, lo hacemos aquí en el controlador
    $organizador = $_POST['organizador'];
    $contactoOrganizador = $_POST['contactoOrganizador'];

    $ubicacion = $_POST['ubicacion'];
    
    $politicaCancelacion = $_POST['politicaCancelacion'];
   
    
    $jsonCategoriaEntrada = $_POST['json'];

    $array = json_decode($jsonCategoriaEntrada, true);
    $horaInicio = $_POST['horaInicio'];
    $horaFin = $_POST['horaFin'];
    $redes = $_POST['redes'];
    
    $fechaCreacion = date("Y-m-d");

    // Comprobar si todos los datos requeridos están presentes
    //if ($id && $nombre && $fecha && $categoria && $ubicacion && $horaInicio && $horaFin && $capacidad && $organizador && $contactoOrganizador && $descripcion && $imagen) {
        // Aquí iría la lógica para procesar los datos
        
        $evento->crearEvento($nombre,$capacidad,$imagen,$descripcion,"",$fecha,$fechaCreacion,"Publicado",$organizador,$contactoOrganizador,$ubicacion,$horaInicio, $horaFin, $redes);
        $id_evento_ultimo = $evento->idMoreLarge();

        foreach($array as $elemento){
            $categoria_evento->crearCategoriaEvento($elemento['categoria'], $elemento['venta'], $elemento['preventa'], $id_evento_ultimo);
        }

        header("Location: ../../public/admin-crear-evento.php");
        exit();
    //}
} else {
    echo "Método no permitido.";
    header("Location: ../../public/admin-crear-evento.php");
        exit();
}

?>