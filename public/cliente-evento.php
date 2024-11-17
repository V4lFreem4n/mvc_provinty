<?php
require_once '../autoload.php';
 

if(!isset($_GET['id'])){
    header("Location: ./cliente-general-eventos.php");
    exit();
}

$id = $_GET['id'];


$conexion = new Database();
$eventoObjeto = new Evento($conexion->connect());
$categoriaEventoObjeto = new Categoria_evento($conexion->connect());

$categoriasEvento   = $categoriaEventoObjeto->mostrarCategoriasEventos();
$eventos            = $eventoObjeto->mostrarEventos();

include '../vista/clientes/cliente-evento.php';
?>
