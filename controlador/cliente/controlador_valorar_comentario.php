<?php
session_start();
include_once '../../autoload.php';
// Verificar si se ha enviado el formulario
$idCliente = $_SESSION['idCliente'];
$idEventos = $_POST['id_evento'];
$conn = new Database();
$db = $conn->connect();
$comentarios = new Interaccion($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar si el campo comentario está establecido y no está vacío
    if (isset($_POST['comentario']) && !empty($_POST['comentario'])) {
        unset($_SESSION['error']);
        $comentario = htmlspecialchars(trim($_POST['comentario']));
        $comentarios->crearInteraccionComentarios($_POST['comentario'],$idCliente,$idEventos);
        header("Location: ../../public/cliente-evento.php?id=".$idEventos);
        exit();
    } else {
        $_SESSION['error'] = "Por favor, escribe un comentario antes de enviar.";
        header("Location: ../../public/cliente-evento.php?id=".$idEventos);
        exit();
    }
} else {
    $_SESSION['error'] = "Método de solicitud no válido.";
    header("Location: ../../public/cliente-evento.php?id=".$idEventos);
    exit();
}
?>

