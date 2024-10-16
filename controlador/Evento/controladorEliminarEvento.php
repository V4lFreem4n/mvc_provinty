<?php

include_once '../../autoload.php';

$conn = new Database();
$evento = new Evento($conn->connect());

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $idEvento = $_POST['id_evento'];
    $evento->eliminarLogicamenteEvento($idEvento);
    $evento->conseguirTiempoBorrado($idEvento);
    

    header("Location: ../../public/admin-crear-evento.php");
    exit();
}
?>