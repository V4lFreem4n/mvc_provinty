<?php

class Interaccion {
    private $connection;

    public function __construct($bd)
    {
     $this->connection = $bd;   
    }

    public function crearTiempoTranscurrido($tiempo, $id_cliente, $id_evento) {
        // Primero comprobamos si ya existe una fila con el id_cliente e id_evento
        $sql_check = "SELECT id FROM interaccion WHERE id_cliente = ? AND id_evento = ?";
        
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
                $sql_update = "UPDATE interaccion SET tiempo = ? + tiempo WHERE id_cliente = ? AND id_evento = ?";
                
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
                $sql_insert = "INSERT INTO interaccion (tiempo, id_cliente, id_evento) VALUES (?, ?, ?)";
                
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

    public function crearInteraccionComentarios($comentario, $id_cliente, $id_evento) {
        // Primero comprobamos si ya existe una fila con el id_cliente e id_evento
        $sql_check = "SELECT id FROM interaccion WHERE id_cliente = ? AND id_evento = ?";
        
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
                $sql_update = "UPDATE interaccion SET comentario = ? WHERE id_cliente = ? AND id_evento = ?";
                
                $stmt_update = mysqli_prepare($this->connection, $sql_update);
                
                if ($stmt_update) {
                    // Vincula los parámetros
                    mysqli_stmt_bind_param($stmt_update, "sii", $comentario, $id_cliente, $id_evento);
                    
                    // Ejecuta la actualización
                    if (mysqli_stmt_execute($stmt_update)) {
                        echo "Comentario actualizado correctamente.";
                    } else {
                        echo "No se pudo actualizar el comentario.";
                    }
                    
                    // Cierra la declaración de actualización
                    mysqli_stmt_close($stmt_update);
                } else {
                    echo "Error en la preparación de la consulta de actualización: " . mysqli_error($this->connection);
                }
            } else {
                // Si no existe, hacemos un INSERT
                $sql_insert = "INSERT INTO interaccion (comentario, id_cliente, id_evento) VALUES (?, ?, ?)";
                
                $stmt_insert = mysqli_prepare($this->connection, $sql_insert);
                
                if ($stmt_insert) {
                    // Vincula los parámetros
                    mysqli_stmt_bind_param($stmt_insert, "sii", $comentario, $id_cliente, $id_evento);
                    
                    // Ejecuta el INSERT
                    if (mysqli_stmt_execute($stmt_insert)) {
                        echo "Comentario creado correctamente.";
                    } else {
                        echo "Error al crear el comentario.";
                    }
                    
                    // Cierra la declaración de inserción
                    mysqli_stmt_close($stmt_insert);
                } else {
                    echo "Error en la preparación de la consulta de inserción: " . mysqli_error($this->connection);
                }
            }
            
            // Cierra la declaración de la consulta de comprobación
            mysqli_stmt_close($stmt_check);
        } else {
            echo "Error en la preparación de la consulta de comprobación: " . mysqli_error($this->connection);
        }
    }

    public function actualizarOcrearInteraccion($estrellas, $id_cliente, $id_evento) {
        // Verificar si ya existe una fila con el mismo id
        $sql = "SELECT * FROM interaccion WHERE id_cliente=? AND id_evento=?";
        $stmt = mysqli_prepare($this->connection, $sql);
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ii", $id_cliente,$id_evento);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
    
            // Si la fila existe, actualizarla
            if ($result && mysqli_num_rows($result) > 0) {
                // Fila existe, hacemos un UPDATE
                $sql_update = "UPDATE interaccion SET estrellas = ? WHERE id_cliente = ? AND id_evento=?";
                $stmt_update = mysqli_prepare($this->connection, $sql_update);
                
                if ($stmt_update) {
                    // Vincula los parámetros
                    mysqli_stmt_bind_param($stmt_update, "iii", $estrellas, $id_cliente, $id_evento);
                    // Ejecuta la actualización
                    mysqli_stmt_execute($stmt_update);
                    mysqli_stmt_close($stmt_update);
    
                    return true; // Fila actualizada correctamente
                }
            } else {
                // Si la fila no existe, insertamos una nueva fila
                $sql_insert = "INSERT INTO interaccion (estrellas, id_cliente, id_evento) VALUES (?, ?, ?)";
                $stmt_insert = mysqli_prepare($this->connection, $sql_insert);
    
                if ($stmt_insert) {
                    // Vincula los parámetros
                    mysqli_stmt_bind_param($stmt_insert, "iii", $estrellas, $id_cliente, $id_evento);
                    // Ejecuta la inserción
                    mysqli_stmt_execute($stmt_insert);
                    mysqli_stmt_close($stmt_insert);
    
                    return true; // Fila insertada correctamente
                }
            }
            
            // Cerrar el statement de selección
            mysqli_stmt_close($stmt);
        }
    
        // Si algo salió mal
        return false;
    }

    public function mostrarInteracciones() {
        $sql = "SELECT i.id, i.comentario, i.estrellas, i.tiempo, i.id_evento, i.id_cliente, c.nombre as nombre_cliente FROM interaccion i 
        INNER JOIN cliente c ON i.id_cliente = c.id";
        $stmt = mysqli_prepare($this->connection, $sql);
    
        if ($stmt) {
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $eventos = [];
    
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $eventos[] = $row;
                }
            }
    
            mysqli_stmt_close($stmt);
            return $eventos;
        }
    
        return false;
    }

    public function obtenerPromedios($id_evento) {
        // SQL para calcular promedios
        $sql = "SELECT 
                    AVG(tiempo) AS tiempo_promedio, 
                    AVG(estrellas) AS estrellas_promedio 
                FROM interaccion 
                WHERE id_evento = ?";
        
        // Preparar la consulta
        $stmt = mysqli_prepare($this->connection, $sql);
        
        if ($stmt) {
            // Vincular los parámetros
            mysqli_stmt_bind_param($stmt, "i", $id_evento);
            
            // Ejecutar la consulta
            mysqli_stmt_execute($stmt);
            
            // Obtener el resultado
            $result = mysqli_stmt_get_result($stmt);
            
            if ($result) {
                // Obtener la fila con los promedios
                $row = mysqli_fetch_assoc($result);
                
                // Cerrar el statement
                mysqli_stmt_close($stmt);
                
                // Retornar los promedios
                return [
                    'tiempo_promedio' => round($row['tiempo_promedio'] ?? 0), // Sin decimales
                    'estrellas_promedio' => round($row['estrellas_promedio'] ?? 0, 1) // 1 decimal si es necesario
                ];
            }
            
            // Cerrar el statement en caso de error
            mysqli_stmt_close($stmt);
        }
        
        // Retornar false si algo falla
        return false;
    }
    
}

?>