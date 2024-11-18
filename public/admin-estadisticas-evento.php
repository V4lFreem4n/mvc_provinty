<?php
require_once '../autoload.php';

session_start();
if(!isset($_SESSION['rol']) || $_SESSION['rol'] == "cliente"){
    header("Location: ./login-trabajadores.php");
        exit();
}

include '../vista/admin/crearEventos/graficos.php';
?>