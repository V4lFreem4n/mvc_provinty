<?php
session_start();
 
include_once '../../../autoload.php';



// Crear una instancia de la conexión a la base de datos y conectarse
$conn = new Database();
$db = $conn->connect();

if (!$db) {
    $_SESSION['error'] = "No se pudo conectar a la base de datos.";
    header("Location: ../../../public/login-trabajadores.php");
    //header("Location: A");
    exit();
}

// Obtener datos del formulario
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
     
    // Ejemplo de redirección con un mensaje de error
    $_SESSION['error'] =  "Por favor, complete todos los campos.";; // Definir el mensaje de error
    header("Location: ../../../public/login-trabajadores.php");
    //header("Location: B");
    exit();
    
}

// Preparar la consulta SQL para verificar el usuario
$sql = "SELECT id, nombre_usuario, rol, password, activo FROM usuarios WHERE correo = '$email'";
$resultado = $conn->ejecutarConsulta($sql);

if ($resultado && $resultado->num_rows === 1) { 
    $user = $resultado->fetch_assoc();
    
    // Verificar si el usuario está activo
    if ($user['activo'] != 1) {
        $_SESSION['error'] = "Esta cuenta está desactivada. Por favor contacte al administrador.";
        header("Location: ../../../public/login-trabajadores.php");
        //header("Location: C");
        exit();
    }
    
    // Verificar la contraseña
    if (password_verify($password, $user['password'])) {
        // Login exitoso
     
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nombre_usuario'];
        
        if($user['rol']==0){
            $_SESSION['rol']='superadministrador';   
        }
        if($user['rol']==1){
            $_SESSION['rol']='administrador'; 
        }
        if($user['rol']==2){
            $_SESSION['rol']='promotor';   
        }
    
        unset($_SESSION['error']);
        // Redirigir a la página principal
        

       /*
         $sql = "SELECT id FROM cliente WHERE nombre_usuario = ? AND correo = ? AND password = ?";
        $stmt = mysqli_prepare($db, $sql);
    
        if ($stmt) {
            // Vincular los parámetros a la consulta
            mysqli_stmt_bind_param($stmt, "sss", $nombreUsuario, $correo, $contrasena);
    
            // Ejecutar la consulta
            mysqli_stmt_execute($stmt);
    
            // Obtener el resultado
            mysqli_stmt_bind_result($stmt, $id);
            mysqli_stmt_fetch($stmt);
    
            // Cerrar el statement
            mysqli_stmt_close($stmt);
    
            // Retornar el ID si se encontró
            if ($id) {
                return $id;
            }
        }
    
        // Retornar null si no se encuentra
        return false;

        */


        header("Location: ../../../public/admin-general.php");
        //header("Location: ../../../vista/admin/gestionGeneral/sepudo.php");
        //exit();
    } else {
        $_SESSION['error'] = "Credenciales incorrectas.";
        header("Location: ../../../public/login-trabajadores.php");
        exit();
    }
} else {
    $_SESSION['error'] = "Credenciales incorrectas.";
    header("Location: ../../../public/login-trabajadores.php");
exit();
}

// Cerrar la conexión
$conn->cerrarConexion();

//header("Location: ../../../public/login-trabajadores.php");
 
