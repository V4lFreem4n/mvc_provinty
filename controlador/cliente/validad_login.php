<?php
session_start();
include_once '../../autoload.php';

$conn = new Database();
$db = $conn->connect();
$cliente = new Cliente($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;

    //echo $email ." -> ".$password;
    //die;

    // Validar que los campos no estén vacíos
    if (!$email || !$password) {
        $_SESSION['error'] = "Por favor, completa todos los campos.";   
        header("Location: ../../public/login-clientes.php");
        exit();
    }

    // Verificar si el correo existe
    if($cliente->verificarCredenciales($email,$password)){
        unset($_SESSION['error']);
        
        $cliente_individual = $cliente->obtenerClientePorCorreoYContrasena($email,$password);
        $_SESSION['roles'] = "cliente";
        $_SESSION['nombre'] = $cliente_individual['nombre'];
        $_SESSION['apellido'] = $cliente_individual['apellido'];
        $_SESSION['correo'] = $cliente_individual['correo'];
        $_SESSION['idCliente'] = $cliente_individual['id'];
        
        
        //Necesito conseguir el id de éste cliente


        header("Location: ../../public/cliente-general-eventos.php");
        exit();
    }else{
        $_SESSION['error'] = "El correo o la contraseña no son válidas.";
        header("Location: ../../public/login-clientes.php");
        exit();
    }
}
?>