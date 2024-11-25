<?php

// controladorCrearEvento.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Inicializar variables y errores
    $errores = [];
    $directorioSubida = '../../uploads/';
    $directorioWeb = 'uploads/';




    // Validar y asignar campos requeridos
    $nombre = trim($_POST['nombre'] ?? '');
    $fecha = trim($_POST['fecha'] ?? '');
    $ubicacion = trim($_POST['ubicacion'] ?? '');
    $horaInicio = trim($_POST['horaInicio'] ?? '');
    $horaFin = trim($_POST['horaFin'] ?? '');
    $capacidad = intval($_POST['capacidad'] ?? 0);
    $organizador = trim($_POST['organizador'] ?? '');
    $contactoOrganizador = trim($_POST['contactoOrganizador'] ?? '');
    $redes = trim($_POST['redes'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');

    // Validar campos requeridos
    if (!$nombre) $errores[] = "El nombre del evento es obligatorio.";
    if (!$fecha) $errores[] = "La fecha es obligatoria.";
    if (!$ubicacion) $errores[] = "La ubicación es obligatoria.";
    if (!$horaInicio) $errores[] = "La hora de inicio es obligatoria.";
    if (!$horaFin) $errores[] = "La hora de fin es obligatoria.";
    if ($capacidad <= 0) $errores[] = "La capacidad debe ser un número positivo.";
    if (!$organizador) $errores[] = "El organizador es obligatorio.";
    if (!$contactoOrganizador) $errores[] = "El contacto del organizador es obligatorio.";
    if (!$redes) $errores[] = "Las redes sociales son obligatorias.";
    if (!$descripcion) $errores[] = "La descripción es obligatoria.";

    // Manejo del archivo de imagen
    $nameImagen = $_FILES['imagen']['name'] ?? '';
    $tmpImagen = $_FILES['imagen']['tmp_name'] ?? '';
    $extImagen = strtolower(pathinfo($nameImagen, PATHINFO_EXTENSION));
    $urlNueva = $directorioWeb . $nameImagen;
    $urlRelativa = $directorioSubida . $nameImagen;
    $extPermitidas = ["png", "gif", "jpg"];

    if ($nameImagen) {
        if (is_uploaded_file($tmpImagen)) {
            if (in_array($extImagen, $extPermitidas)) {
                if (!move_uploaded_file($tmpImagen, $urlRelativa)) {
                    $errores[] = "Error al guardar la imagen.";
                } else {
                    chmod($urlRelativa, 0777);
                }
            } else {
                $errores[] = "Formato de imagen no permitido. Use jpg, png o gif.";
            }
        } else {
            $errores[] = "Error al subir la imagen. Inténtelo de nuevo.";
        }
    } else {
        $errores[] = "Debe seleccionar una imagen.";
    }

    // Procesar los datos si no hay errores
    if (empty($errores)) {
        // Crear evento (aquí puedes usar tu lógica para guardar en la base de datos)
        // Asegúrate de que $evento está inicializado y es una instancia válida
        $evento->crearEvento(
            $nombre,
            $capacidad,
            $urlNueva,
            $descripcion,
            "artista",
            "condiciones",
            $fecha,
            $fecha,
            "Borrador",
            $organizador,
            $contactoOrganizador,
            $ubicacion,
            $horaInicio,
            $horaFin,
            $redes,
            $_SESSION['usuario_id']
        );

        echo json_encode(['status' => 'success', 'message' => 'Evento creado con éxito.']);
    } else {
        echo json_encode(['status' => 'error', 'errors' => $errores]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido.']);
}

?>
