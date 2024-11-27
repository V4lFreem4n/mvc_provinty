<?php
require_once "../../autoload.php";
session_start();

$conn = new Database();
$evento = new Evento($conn->connect());
$categoria_evento = new Categoria_evento($conn->connect());

$errores = [];
$directorioSubida = '../../uploads/';
$directorioWeb = 'uploads/'; // Ruta para acceder desde el navegador

$id_evento_proximo = $evento->proximoId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Verifica si hay sesión activa
    $id_usuario_pk = $_SESSION['usuario_id'] ?? null;
    if (!$id_usuario_pk) {
        exit("Error: Usuario no identificado. Inicie sesión.");
    }

    // Datos básicos
    $nombre = $_POST['nombre'];
    $capacidad = $_POST['capacidad'];
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha'];
    $organizador = $_POST['organizador'];
    $contactoOrganizador = $_POST['contactoOrganizador'];
    $ubicacion = $_POST['ubicacion'];
    $politicaCancelacion = $_POST['politicaCancelacion'];

    // Fechas adicionales
    $fechaCreacion = date("Y-m-d");

    // Procesar imagen
    $nameImagen = $_FILES['imagen']['name'] ?? '';
    $tmpImagen = $_FILES['imagen']['tmp_name'] ?? '';
    $extImagen = strtolower(pathinfo($nameImagen, PATHINFO_EXTENSION));
    $urlNueva = $directorioWeb . $id_evento_proximo;
    $urlRelativa = $directorioSubida . $id_evento_proximo.".png";
    $extPermitidas = ["png"];

    if ($nameImagen) {
        if (is_uploaded_file($tmpImagen)) {
            if (in_array($extImagen, $extPermitidas)) {
                if (!move_uploaded_file($tmpImagen, $urlRelativa)) {
                    exit("Error al guardar la imagen en: $urlRelativa. Verifique permisos y ruta.");
                } else {
                    chmod($urlRelativa, 0777);
                    echo "Imagen subida correctamente en: $urlRelativa.";
                }
            } else {
                exit("Formato de imagen no permitido. Extensión: $extImagen.");
            }
        } else {
            exit("Error al subir la imagen. Inténtelo de nuevo.");
        }
    } else {
        exit("Debe seleccionar una imagen.");
    }



    // Procesar términos y condiciones
    $JSON_terminos_condiciones = html_entity_decode($_POST['json_terminos_condiciones']);
    $terminos_condiciones_array = json_decode($JSON_terminos_condiciones, true);
    $terminos_condiciones_json = json_encode($terminos_condiciones_array);

    // Procesar categorías de entradas
    $jsonCategoriaEntrada = $_POST['json'];
    $array = json_decode($jsonCategoriaEntrada, true);

    // Otros datos
    $horaInicio = $_POST['horaInicio'];
    $horaFin = $_POST['horaFin'];
    $redes = $_POST['redes'];

    // Crear evento en la base de datos
   

    $evento->crearEvento(
        $nombre,
        $capacidad,
        $id_evento_ultimo.".png", //Este será el nombre de la imagen
        $descripcion,
        $terminos_condiciones_json,
        "",
        $fecha,
        $fechaCreacion,
        "Publicado",
        $organizador,
        $contactoOrganizador,
        $ubicacion,
        $horaInicio,
        $horaFin,
        $redes,
        $id_usuario_pk
    );

    // Obtener ID del último evento creado
    

    // Crear categorías del evento
    foreach ($array as $elemento) {
        $categoria_evento->crearCategoriaEvento($elemento['categoria'], $elemento['venta'], $elemento['preventa'], $id_evento_proximo);
    }

    // Redirigir después de la creación exitosa
    header("Location: ../../public/admin-crear-evento.php");
    exit();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido.']);
    header("Location: ../../public/admin-crear-evento.php");
    exit();
}
