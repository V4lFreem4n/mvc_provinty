<?php
require_once '../autoload.php';

//Acá le tenemos que pasar todas las variables que se necesitan, okey?
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['rol']) && $_SESSION['rol'] === 1 && $_SESSION['tipoInterfaz'] == "admin") {
   
} else {
   
    header("Location: ./login-admin.php"); 
    exit();
}

include '../vista/admin/crearEventos/graficos.php';
?>