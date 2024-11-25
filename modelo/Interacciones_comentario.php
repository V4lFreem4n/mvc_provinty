<?php

class InteraccionesComentario {

    private $connection;

    public function __construct($bd)
    {
     $this->connection = $bd;   
    }

    public function crearInteraccionComentarios($comentario ,$id_cliente, $id_evento) {
    
    
        // Consulta SQL actualizada para incluir los nuevos campos
        $sql = "INSERT INTO interaccion_comentarios (comentarios, id_cliente, id_evento) 
                VALUES (?, ?, ?)";
        
        // Prepara la declaración
        $stmt = mysqli_prepare($this->connection, $sql);
        
        if ($stmt) {
            // Vincula los parámetros
            mysqli_stmt_bind_param($stmt, "sii", $comentario, $id_cliente, $id_evento);
        
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

    public function mostrarInteracciones() {
        $sql = "SELECT * FROM interaccion_comentarios";
        $result = mysqli_query($this->connection, $sql);
        $eventos = [];
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $eventos[] = $row; // Agregar cada fila al array
            }
        }
    
        return $eventos; // Devuelve un array de eventos
    }

    public function mostrarInteraccionesById($id) {
        $sql = "SELECT * FROM interaccion_comentarios WHERE id=?";
        $stmt = mysqli_prepare($this->connection, $sql);
    
        if ($stmt) {
            // Vincular los parámetros a la consulta
            mysqli_stmt_bind_param($stmt, "i", $id);
    
            // Ejecutar la consulta
            mysqli_stmt_execute($stmt);
    
            // Obtener el resultado
            $result = mysqli_stmt_get_result($stmt);
    
            // Verificar si hay resultados
            if ($result && mysqli_num_rows($result) > 0) {
                // Devolver los datos del usuario como un array asociativo
                return mysqli_fetch_assoc($result);
            }
    
            // Cerrar el statement
            mysqli_stmt_close($stmt);
        }
    
        // Retornar null si no se encuentra
        return false;
    }

}
    ?>