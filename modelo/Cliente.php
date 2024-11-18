<?php

class Cliente {

    private $connection;

    public function __construct($bd)
    {
     $this->connection = $bd;   
    }

    public function crearCliente($nombre, $apellido, $documento_identidad, $fecha_nacimiento, $correo, $contrasena) {
    
    
        // Consulta SQL actualizada para incluir los nuevos campos
        $sql = "INSERT INTO cliente (nombre, apellido, documento_identidad, fecha_nacimiento, correo, contrasena) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        // Prepara la declaración
        $stmt = mysqli_prepare($this->connection, $sql);
        
        if ($stmt) {
            // Vincula los parámetros
            mysqli_stmt_bind_param($stmt, "ssisss", $nombre, $apellido, $documento_identidad, $fecha_nacimiento, $correo, $contrasena);
        
            // Ejecuta la declaración
            mysqli_stmt_execute($stmt);
        
            // Verifica si la inserción fue exitosa
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "Evento creado correctamente.";
            } else {
                echo "Error al crear el evento.";
            }
        
            // Cierra la declaración
            mysqli_stmt_close($stmt);
        } else {
            echo "Error en la preparación de la consulta: " . mysqli_error($this->connection);
        }
    }

    public function mostrarClientes() {
        $sql = "SELECT * FROM cliente";
        $result = mysqli_query($this->connection, $sql);
        $cliente = [];
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $cliente[] = $row; // Agregar cada fila al array
            }
        }
    
        return $cliente; // Devuelve un array de clientes
    }

    public function mostrarClientesByEmail($correo) {
        $sql = "SELECT * FROM cliente WHERE correo='$correo' LIMIT 1"; // LIMIT 1 asegura que solo devuelvas un resultado
        $result = mysqli_query($this->connection, $sql);
        
        // Comprobar si se obtuvo el resultado
        if ($result) {
            // Obtener el primer (y único) cliente
            $cliente = mysqli_fetch_assoc($result);
            return $cliente; // Devuelve el cliente encontrado (un solo array)
        }
    
        return false; // Si no se encontró el cliente, devolver false
    }
    

    public function contarClientesCreados(){
        // Consulta para contar las filas en la tabla eventos
        $sql = "SELECT COUNT(*) AS total FROM cliente";

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

    public function verificarCredenciales($email, $password) {
        // Consulta para obtener la contraseña almacenada
        $sql = "SELECT contrasena FROM cliente WHERE correo = ?";
        $stmt = mysqli_prepare($this->connection, $sql);
    
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $stored_password);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
    
            // Si no se encontró el correo o la contraseña no coincide
            if (!$stored_password || $stored_password !== $password) {
                return false; // Credenciales inválidas
            }
    
            // Credenciales válidas
            return true;
        }
    
        return false; // Por defecto, credenciales inválidas
    }
    
    

    public function existeCorreo($correo) {
        // Consulta para verificar si el correo ya existe
        $sql = "SELECT COUNT(*) AS total FROM cliente WHERE correo = ?";
    
        // Prepara la declaración
        $stmt = mysqli_prepare($this->connection, $sql);
    
        if ($stmt) {
            // Vincula los parámetros
            mysqli_stmt_bind_param($stmt, "s", $correo);
    
            // Ejecuta la consulta
            mysqli_stmt_execute($stmt);
    
            // Vincula el resultado
            mysqli_stmt_bind_result($stmt, $total);
    
            // Obtiene el resultado
            mysqli_stmt_fetch($stmt);
    
            // Cierra la declaración
            mysqli_stmt_close($stmt);
    
            // Si el total es mayor a 0, el correo ya existe
            return $total > 0;
        } else {
            echo "Error en la preparación de la consulta: " . mysqli_error($this->connection);
            return false;
        }
    }
    

    public function idMoreLarge(){
        $sql = "SELECT MAX(id) AS max_id FROM cliente";
        $result = mysqli_query($this->connection, $sql);
        
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $max_id = $row['max_id'];
            return $max_id;
        } else {
            return 0;
        }
    }

}