<?php
session_start();

// Configuración de la base de datos
$db_host = 'localhost';
$db_user = 'victor';
$db_pass = 'victor';
$db_name = 'provintybd';

// Crear conexión
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener datos del formulario
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    $_SESSION['error'] = "Por favor, complete todos los campos.";
    header("Location: login_trabajadores.php");
    exit();
}

// Preparar la consulta SQL
$stmt = $conn->prepare("SELECT id, nombre_usuario, password, activo FROM usuarios WHERE correo = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    
    // Verificar si el usuario está activo
    if ($user['activo'] != 1) {
        $_SESSION['error'] = "Esta cuenta está desactivada. Por favor contacte al administrador.";
        header("Location: login_trabajadores.php");
        exit();
    }
    
    // Verificar la contraseña
    if (password_verify($password, $user['password'])) {
        // Login exitoso
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nombre_usuario'];
        
        // Redirigir a la página principal
        header("Location: principal.html");
        exit();
    } else {
        $_SESSION['error'] = "Credenciales incorrectas.";
    }
} else {
    $_SESSION['error'] = "Credenciales incorrectas.";
}

$stmt->close();
$conn->close();

header("Location: login_trabajadores.php");
exit();