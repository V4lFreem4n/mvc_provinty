<?php
require_once '../autoload.php';
session_start();

if(!isset($_SESSION['rol']) && !($_SESSION['rol'] == "superadministrador" || $_SESSION['rol'] == "administrador" ||$_SESSION['rol'] == "promotor")){
    header("Location: ./login-trabajadores.php");
        exit();
}



//Acá le tenemos que pasar todas las variables que se necesitan, okey?
$conexion = new Database();
$eventoObjeto = new Evento($conexion->connect());
$eventos = $eventoObjeto->mostrarEventos();


include '../vista/admin/informe/informes_eventos.php';

?>