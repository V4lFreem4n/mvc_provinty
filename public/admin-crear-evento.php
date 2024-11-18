<?php
session_start();

require_once '../autoload.php';

if(!isset($_SESSION['rol']) || $_SESSION['rol'] == "cliente"){
    header("Location: ./login-trabajadores.php");
        exit();
}


//Acá le tenemos que pasar todas las variables que se necesitan, okey?
$conexion = new Database();
$eventoObjeto = new Evento($conexion->connect());
$eventos = $eventoObjeto->mostrarEventos();

include '../vista/admin/crearEventos/admin-crear-evento-view.php';

?>