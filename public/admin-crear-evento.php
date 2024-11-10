<?php
require_once '../autoload.php';

/*
 session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['rol']) && $_SESSION['rol'] === 1 && $_SESSION['tipoInterfaz'] == "admin") {
    
   
} else {
   
    header("Location: ./login-admin.php"); 
    exit();
}
 */

//Acá le tenemos que pasar todas las variables que se necesitan, okey?
$conexion = new Database();
$eventoObjeto = new Evento($conexion->connect());
$eventos = $eventoObjeto->mostrarEventos();

include '../vista/admin/crearEventos/admin-crear-evento-view.php';

?>