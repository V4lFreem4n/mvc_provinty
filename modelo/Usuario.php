<?php

class Usuario {

    private $connection;

    public function __construct($bd)
    {
     $this->connection = $bd;   
    }

    public function crearUsuario($Nombre,$username , $Apellido, $Rol, $Contraseña, $DNI, $Fecha_Creacion_Cuenta) {
        // Supongamos que $this->conexion es tu conexión a la base de datos
        $sql = "INSERT INTO usuarios (Nombre,username, Apellido, Rol, Contraseña, DNI, Fecha_Creacion_Cuenta) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
    
        // Prepara la declaración
        $stmt = mysqli_prepare($this->connection, $sql);
    
        if ($stmt) {
            // Vincula los parámetros
            mysqli_stmt_bind_param($stmt, "sssssis", $Nombre, $username, $Apellido, $Rol, $Contraseña, $DNI, $Fecha_Creacion_Cuenta);
    
            // Ejecuta la declaración
            mysqli_stmt_execute($stmt);
    
            // Verifica si la inserción fue exitosa
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "Usuario creado correctamente.";
            } else {
                echo "Error al crear el usuario.";
            }
    
            // Cierra la declaración
            mysqli_stmt_close($stmt);
        } else {
            echo "Error en la preparación de la consulta: " . mysqli_error($this->connection);
        }
    }
    
    public function mostrarUsuario() {
        $sql = "SELECT * FROM usuarios";
        $result = mysqli_query($this->connection, $sql);
        $usuarios = [];
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $usuarios[] = $row; // Agregar cada fila al array
            }
        }
    
        return $usuarios; // Devuelve un array de usuarios
    }

    public function getUser($username) {
        // Usamos una declaración preparada para evitar inyección SQL
        $sql = "SELECT * FROM usuarios WHERE username = ?";
        $stmt = mysqli_prepare($this->connection, $sql);
    
        if ($stmt) {
            // Vincula el parámetro, indicando que es una cadena (s)
            mysqli_stmt_bind_param($stmt, "s", $username);
    
            // Ejecuta la declaración
            mysqli_stmt_execute($stmt);
    
            // Obtener el resultado de la consulta
            $result = mysqli_stmt_get_result($stmt);
            $usuarios = [];
    
            // Verificar y procesar los resultados
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $usuarios[] = $row; // Agregar cada fila al array
                }
            }
    
            // Cierra la declaración
            mysqli_stmt_close($stmt);
    
            return $usuarios; // Devuelve el array con los usuarios
        } else {
            echo "Error en la consulta: " . mysqli_error($this->connection);
            return null; // En caso de error, devolvemos null
        }
    }
    
    

    public function contarUsuarioCreados(){
        // Consulta para contar las filas en la tabla usuarios
        $sql = "SELECT COUNT(*) AS total FROM usuarios";

        // Ejecuta la consulta
        $result = mysqli_query($this->connection, $sql);

        // Verifica si se obtuvo un resultado
        if ($result) {
        $row = mysqli_fetch_assoc($result);
        return (int)$row['total']; // Devuelve el total de filas
        } else {
        // Si hay un error, puedes manejarlo aquí
        echo "Error en la consulta: " . mysqli_error($this->connection);
        return 0; // Devuelve 0 en caso de error
        }
    }


    public function eliminarUsuario($id) {
        // Consulta para eliminar un evento por id
        $sql = "DELETE FROM usuarios WHERE ID_Usuario = ?";
    
        // Prepara la declaración
        $stmt = mysqli_prepare($this->connection, $sql);
    
        if ($stmt) {
            // Vincula el parámetro
            mysqli_stmt_bind_param($stmt, "i", $id); // 'i' indica que el parámetro es un entero
    
            // Ejecuta la declaración
            mysqli_stmt_execute($stmt);
    
            // Verifica si se eliminó algún registro
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "Evento eliminado correctamente.";
            } else {
                echo "No se encontró un evento con ese ID o ya ha sido eliminado.";
            }
    
            // Cierra la declaración
            mysqli_stmt_close($stmt);
        } else {
            echo "Error en la preparación de la consulta: " . mysqli_error($this->connection);
        }
    }

    public function editarUsuario($Nombre, $Apellido, $Rol, $Contraseña, $DNI, $Fecha_Creacion_Cuenta) {
        // Consulta para actualizar un evento
        $sql = "UPDATE usuarios SET 
                    Nombre = ?, Apellido = ?, Rol = ?, Contraseña = ?, DNI = ?, Fecha_Creacion_Cuenta = ? 
                WHERE ID_usuario = ?";
    
        // Prepara la declaración
        $stmt = mysqli_prepare($this->connection, $sql);
    
        if ($stmt) {
            // Vincula los parámetros
            mysqli_stmt_bind_param($stmt, "siisssssssssi", 
            $Nombre, $Apellido, $Rol, $Contraseña, $DNI, $Fecha_Creacion_Cuenta, $id); // El último parámetro es el ID
    
            // Ejecuta la declaración
            mysqli_stmt_execute($stmt);
    
            // Verifica si se actualizó algún registro
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "Usuario actualizado correctamente.";
            } else {
                echo "No se encontró un Usuario con ese ID o no se realizaron cambios.";
            }
    
            // Cierra la declaración
            mysqli_stmt_close($stmt);
        } else {
            echo "Error en la preparación de la consulta: " . mysqli_error($this->connection);
        }
    }

    public function verificarUsuario($usuario, $contraseña) {
        // Consulta SQL para verificar si el usuario y la contraseña coinciden
        $sql = "SELECT * FROM usuarios WHERE username = ?"; // Asumimos que el usuario se identifica por DNI
        
        // Prepara la declaración
        $stmt = mysqli_prepare($this->connection, $sql);
        
        if ($stmt) {
            // Vincula el parámetro (DNI del usuario)
            mysqli_stmt_bind_param($stmt, "s", $usuario); // 's' indica que el parámetro es una cadena de texto
            
            // Ejecuta la declaración
            mysqli_stmt_execute($stmt);
            
            // Obtén el resultado
            $result = mysqli_stmt_get_result($stmt);
            
            // Verifica si se encontró algún registro
            if ($row = mysqli_fetch_assoc($result)) {
                // Si la contraseña está en texto plano (aunque no es recomendado), compara directamente:
                if ($row['Contraseña'] === $contraseña) {
                    // Usuario y contraseña coinciden
                    return true;
                }
                // Si la contraseña está almacenada como hash, usa password_verify
                // if (password_verify($contraseña, $row['Contraseña'])) {
                //     return true;
                // }
            }
            
            // Cierra la declaración
            mysqli_stmt_close($stmt);
        } else {
            echo "Error en la preparación de la consulta: " . mysqli_error($this->connection);
        }
        
        // Si no hay coincidencia, devuelve false
        return false;
    }
    
    
    

}

?>