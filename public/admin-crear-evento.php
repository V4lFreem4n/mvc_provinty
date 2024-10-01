<?php
require_once '../autoload.php';

//Acá le tenemos que pasar todas las variables que se necesitan, okey?
$conexion = new Database();
$eventoObjeto = new Evento($conexion->connect());
$eventos = $eventoObjeto->mostrarEventos();

include '../vista/admin/crearEventos/admin-crear-evento-view.php';

?>