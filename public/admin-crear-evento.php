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

//Vamos a crear un array asociativo con los ID y su respectivos datos de usuario
$listaEventosPorUsuarios= []; //-> Esta variable es un array que vamos a exportar okeY?

foreach($eventos as $eventito){
    $datosUsuario = $eventoObjeto->obtenerUsuarioPorIdEvento($eventito['id_usuario']); 
    $nombre_user_event = $datosUsuario['nombre_usuario'];
    $correo_user_event = $datosUsuario['correo'];
    $listaEventosPorUsuarios[$eventito['id_usuario']] = ['nombre_usuario' => $nombre_user_event,'correo' => $correo_user_event];
}

include '../vista/admin/crearEventos/admin-crear-evento-view.php';

?>