<?php
require_once '../autoload.php';

session_start();
if(!isset($_SESSION['rol']) && ($_SESSION['rol'] == "superadministrador" || $_SESSION['rol'] == "administrador" ||$_SESSION['rol'] == "promotor")){
    header("Location: ./login-trabajadores.php");
        exit();
}

if(!isset($_GET['id'])){
    header("Location: ./admin-general.php");
    exit();
}

$id = $_GET['id'];


$db = new Database();
$eventosObjeto = new Evento($db->connect());
$interaccion_tiempo = new Interaccion_tiempo($db->connect());
$interaccion_comentario = new InteraccionesComentario($db->connect());
$interaccion_estrellas = new InteraccionesEstrellas($db->connect());
$clienteObjeto = new Cliente($db->connect());

$tiempo = $interaccion_tiempo->mostrarInteracciones();
$comentarios = $interaccion_comentario->mostrarInteracciones();
$clientes = $clienteObjeto->mostrarClientes();
$eventos = $eventosObjeto->mostrarEventos();
$estrellas = $interaccion_estrellas->mostrarInteracciones();

$listaEventosInteractuados = [];

foreach($comentarios as $comentario){
if($comentario['id_evento']==$id){

    foreach($estrellas as $estrella){
        if($estrella['id_evento']==$id){
            
            $listaEventosInteractuados = ['cliente' => 'cliente', 'estrellas' => $estrella['estrellas'], 'comentario' => 3];

        }
    }

}
}



include '../vista/admin/informe/detalle_informes.php';

?>