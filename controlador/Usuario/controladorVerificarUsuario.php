<?php
include_once '../../autoload.php';

 $conn = new Database();
$usuarioModel = new Usuario($conn->connect());
session_start();
//Acá vamos a hacer la consulta a la bd para que cambie el estado

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['usuario'];
    $password = $_POST['password'];

    if($usuarioModel->verificarUsuario($user, $password)){
        //$_SESSION['user_id'] = $user;
        
        $usuario = $usuarioModel->getUser($user);
        $_SESSION['tipoInterfaz'] = "admin";
        $_SESSION['username'] = $user;
        $_SESSION['user_id'] = $usuario[0]['ID_Usuario'];
        $_SESSION['nombre'] = $usuario[0]['Nombre'];
        $_SESSION['apellido'] = $usuario[0]['Apellido'];
        $_SESSION['rol'] = $usuario[0]['Rol'];
        $_SESSION['dni'] = $usuario[0]['DNI'];
        $_SESSION['fecha_creacion'] = $usuario[0]['Fecha_Creacion_Cuenta'];

        header("Location: ../../public/admin-crear-evento.php");
        exit();
    }else{
        header("Location: ../../public/login-admin.php?error=No+existe+el+usuario");
        exit();
    }
}  

 

?>