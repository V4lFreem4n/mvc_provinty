<?php

class Interacciones {

    private $connection;

    public function __construct($bd)
    {
     $this->connection = $bd;   
    }

    public function crearInteraccion($id_cliente, $id_evento, $valoracion, $comentario) {
     
    
        // Consulta SQL actualizada para incluir los nuevos campos
        $sql = "INSERT INTO interacciones (id_cliente, id_evento, valoracion, comentario) 
                VALUES (?, ?, ?, ?)";
        
        // Prepara la declaración
        $stmt = mysqli_prepare($this->connection, $sql);
        
        if ($stmt) {
            // Vincula los parámetros
            mysqli_stmt_bind_param($stmt, "iiis", $id_cliente, $id_evento, $valoracion, $comentario);
        
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

    public function mostrarInteraccionByIdEvento($id_evento){
        $sql = "SELECT * FROM interacciones WHERE id_evento = ?";
        $result = mysqli_query($this->connection, $sql);
        $interacciones = [];
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $interacciones[] = $row; // Agregar cada fila al array
            }
        }
    
        return $interacciones; // Devuelve un array de eventos
    }

    public function mostrarInteraccionByIdCliente($id_cliente){
        $sql = "SELECT * FROM interacciones WHERE id_cliente = ?";
        $result = mysqli_query($this->connection, $sql);
        $interacciones = [];
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $interacciones[] = $row; // Agregar cada fila al array
            }
        }
    
        return $interacciones; // Devuelve un array de eventos
    }

    public function mostrarInteracciones(){
        $sql = "SELECT * FROM interacciones";
        $result = mysqli_query($this->connection, $sql);
        $interacciones = [];
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $interacciones[] = $row; // Agregar cada fila al array
            }
        }
    
        return $interacciones; // Devuelve un array de eventos
    }

}