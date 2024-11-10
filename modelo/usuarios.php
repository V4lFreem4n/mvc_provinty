<?php
include '../autoload.php';
$conexion = new Database();
$conexion->connect();


$accion = $_POST['accion'];

switch ($accion) {
    case 'crear':
        crearUsuario();
        break;
    case 'editar':
        editarUsuario();
        break;
    case 'eliminar':
        eliminarUsuario();
        break;
    case 'activar_desactivar':
        activarDesactivarUsuario();
        break;
    case 'obtener':
        obtenerUsuarios();
        break;
}

function crearUsuario() {
    global $conexion;

    $nombreUsuario = $_POST['nombreUsuario'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
    $rol = $_POST['rol'];
    $dni = $_POST['dni'];
    $correo = $_POST['correo'];
    $numero = $_POST['numero'];

    // Verificar duplicados
    $sqlDuplicados = "SELECT * FROM usuarios WHERE dni='$dni' OR correo='$correo' OR numero_telefono='$numero' OR nombre_usuario='$nombreUsuario'";
    $resultado = $conexion->ejecutarConsulta($sqlDuplicados);

    if ($resultado->num_rows > 0) {
        echo json_encode(['error' => 'Ya existe un usuario con el mismo DNI, correo, número o nombre de usuario.']);
        return;
    }

    // Insertar nuevo usuario
    $sql = "INSERT INTO usuarios (nombre_usuario, password, rol, dni, correo, numero_telefono, activo) 
            VALUES ('$nombreUsuario', '$contrasena', '$rol', '$dni', '$correo', '$numero', 1)";
    
    if ($conexion->ejecutarConsulta($sql)) {
        echo json_encode(['success' => 'Usuario creado correctamente']);
    } else {
        echo json_encode(['error' => 'Error al crear usuario']);
    }
}

function obtenerUsuarios() {
    global $conexion;
    
    // Obtener página actual (por defecto 1)
    $pagina = isset($_POST['pagina']) ? max(1, (int)$_POST['pagina']) : 1;
    $porPagina = 10; // Usuarios por página
    $inicio = ($pagina - 1) * $porPagina;
    
    // Obtener total de usuarios para calcular páginas totales
    $sqlTotal = "SELECT COUNT(*) as total FROM usuarios";
    $resultadoTotal = $conexion->ejecutarConsulta($sqlTotal);

    if (!$resultadoTotal) {
        echo json_encode(['error' => 'Error al obtener el total de usuarios']);
        return;
    }
    
    $totalUsuarios = $resultadoTotal->fetch_assoc()['total'];
    $totalPaginas = ceil($totalUsuarios / $porPagina);
    
    // Obtener usuarios de la página actual
    $sql = "SELECT * FROM usuarios LIMIT $inicio, $porPagina";
    $resultado = $conexion->ejecutarConsulta($sql);

    if (!$resultado) {
        echo json_encode(['error' => 'Error al obtener la lista de usuarios']);
        return;
    }
    
    $usuarios = [];
    while ($fila = $resultado->fetch_assoc()) {
        $usuarios[] = $fila;
    }
    
    echo json_encode([
        'usuarios' => $usuarios,
        'totalPaginas' => $totalPaginas,
        'paginaActual' => $pagina
    ]);
}


function editarUsuario() {
    global $conexion;
    
    $id = $_POST['id'];
    $nombreUsuario = $_POST['nombreUsuario'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
    $rol = $_POST['rol'];
    $correo = $_POST['correo'];
    $numero = $_POST['numero'];

    // Verificar duplicados al editar
    $sqlDuplicados = "SELECT * FROM usuarios WHERE id != $id AND (correo='$correo' OR numero_telefono='$numero' OR nombre_usuario='$nombreUsuario')";
    $resultado = $conexion->ejecutarConsulta($sqlDuplicados);
    
    if ($resultado->num_rows > 0) {
        echo json_encode(['error' => 'Ya existe un usuario con el mismo correo, número o nombre de usuario.']);
        return;
    }

    // Actualizar usuario
    $sql = "UPDATE usuarios SET nombre_usuario='$nombreUsuario', /*password='$contrasena',*/ rol='$rol', correo='$correo', numero_telefono='$numero'"; /*WHERE id=$id";*/

    // Agregar la contraseña a la actualización solo si se proporcionó una nueva
    if (isset($_POST['contrasena']) && !empty($_POST['contrasena'])) {
        $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
        $sql .= ", password='$contrasena'";
    }

    $sql .= " WHERE id=$id";

    if ($conexion->ejecutarConsulta($sql)) {
        echo json_encode(['success' => 'Usuario editado correctamente']);
    } else {
        echo json_encode(['error' => 'Error al editar usuario']);
    }
}

function eliminarUsuario() {
    global $conexion;
    $id = $_POST['id'];
    $sql = "DELETE FROM usuarios WHERE id=$id";
    
    if ($conexion->ejecutarConsulta($sql)) {
        echo json_encode(['success' => 'Usuario eliminado correctamente']);
    } else {
        echo json_encode(['error' => 'Error al eliminar usuario']);
    }
}

function activarDesactivarUsuario() {
    global $conexion;
    $id = $_POST['id'];
    $activo = $_POST['activo'];
    $sql = "UPDATE usuarios SET activo=$activo WHERE id=$id";

    if ($conexion->ejecutarConsulta($sql)) {
        echo json_encode(['success' => 'Estado de usuario actualizado']);
    } else {
        echo json_encode(['error' => 'Error al actualizar estado']);
    }
}

$conexion->cerrarConexion();
?>
