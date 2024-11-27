<?php
try {
    session_start();
    include_once '../../autoload.php';
    header('Content-Type: application/json');

    // Inicializar la base de datos y clase de eventos
    $bd = new Database();
    $eventoClase = new Evento($bd->connect());
    $eventos = $eventoClase->mostrarEventos();

    // Verificar si hay eventos disponibles
    if (!$eventos || count($eventos) === 0) {
        throw new Exception('No hay eventos disponibles.');
    }

    // Construir lista de eventos para el carrusel
    $listaEventosCarousel = [];
    $cantidadEventos = 0;
//Sólo vamos a enviar los eventos que estén públicos y no privados.

    foreach ($eventos as $evento) {
        if ($cantidadEventos < 3 && $evento['visibilidad']=="Público") {
            $listaEventosCarousel[] = [
                'nombre_evento' => htmlspecialchars($evento['Titulo']),
                'nombre_imagen' => htmlspecialchars($evento['Foto']),
                'fecha' => htmlspecialchars($evento['Fecha_Evento']),
                'artista' => htmlspecialchars($evento['Artista_Autor']),
            ];
            $cantidadEventos++;
        } 
    }

    echo json_encode([
        'status' => 'success',
        'message' => 'Eventos cargados correctamente.',
        'data' => $listaEventosCarousel
    ], JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
?>
