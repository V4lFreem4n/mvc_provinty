<?php

class Interaccion_tiempo {
    private $connection;

    public function __construct($bd)
    {
     $this->connection = $bd;   
    }

    public function crearTiempoTranscurrido($tiempo, $id_cliente, $id_evento) {
        // Primero comprobamos si ya existe una fila con el id_cliente e id_evento
        $sql_check = "SELECT id FROM interaccion_tiempo WHERE id_cliente = ? AND id_evento = ?";
        
        // Prepara la declaración para la consulta SELECT
        $stmt_check = mysqli_prepare($this->connection, $sql_check);
        
        if ($stmt_check) {
            // Vincula los parámetros
            mysqli_stmt_bind_param($stmt_check, "ii", $id_cliente, $id_evento);
            
            // Ejecuta la consulta
            mysqli_stmt_execute($stmt_check);
            
            // Almacena los resultados para procesarlos correctamente
            mysqli_stmt_store_result($stmt_check);
            
            // Verificamos si se encontró algún resultado
            if (mysqli_stmt_num_rows($stmt_check) > 0) {
                // Si existe una fila con el mismo id_cliente e id_evento, actualizamos el comentario
                $sql_update = "UPDATE interaccion_tiempo SET tiempo = ? + tiempo WHERE id_cliente = ? AND id_evento = ?";
                
                $stmt_update = mysqli_prepare($this->connection, $sql_update);
                
                if ($stmt_update) {
                    // Vincula los parámetros
                    mysqli_stmt_bind_param($stmt_update, "iii", $tiempo, $id_cliente, $id_evento);
                    
                    // Ejecuta la actualización
                    if (mysqli_stmt_execute($stmt_update)) {
                        return "tiempo actualizado correctamente.";
                    } else {
                        return "No se pudo actualizar el comentario.";
                    }
                    
                    // Cierra la declaración de actualización
                    mysqli_stmt_close($stmt_update);
                } else {
                    return "Error en la preparación de la consulta de actualización: " . mysqli_error($this->connection);
                }
            } else {
                // Si no existe, hacemos un INSERT
                $sql_insert = "INSERT INTO interaccion_tiempo (tiempo, id_cliente, id_evento) VALUES (?, ?, ?)";
                
                $stmt_insert = mysqli_prepare($this->connection, $sql_insert);
                
                if ($stmt_insert) {
                    // Vincula los parámetros
                    mysqli_stmt_bind_param($stmt_insert, "iii", $tiempo, $id_cliente, $id_evento);
                    
                    // Ejecuta el INSERT
                    if (mysqli_stmt_execute($stmt_insert)) {
                        return "Comentario creado correctamente.";
                    } else {
                        return "Error al crear el comentario.";
                    }
                    
                    // Cierra la declaración de inserción
                    mysqli_stmt_close($stmt_insert);
                } else {
                    return "Error en la preparación de la consulta de inserción: " . mysqli_error($this->connection);
                }
            }
            
            // Cierra la declaración de la consulta de comprobación
            mysqli_stmt_close($stmt_check);
        } else {
            return "Error en la preparación de la consulta de comprobación: " . mysqli_error($this->connection);
        }
    }

    public function mostrarInteracciones() {
        $sql = "SELECT * FROM interaccion_tiempo";
        $stmt = mysqli_prepare($this->connection, $sql);
    
        if ($stmt) {
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $eventos = [];
    
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $eventos[] = $row; // Agregar cada fila al array
                }
            }
    
            mysqli_stmt_close($stmt);
            return $eventos; // Devuelve un array de eventos
        }
    
        return false; // Si no hay resultados
    }
}

?>