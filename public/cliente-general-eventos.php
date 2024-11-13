<?php
require_once '../autoload.php';

$conexion = new Database();
$eventoObjeto = new Evento($conexion->connect());
$eventos = $eventoObjeto->mostrarEventos();


include '../vista/clientes/cliente_eventos_lista.php';
?>