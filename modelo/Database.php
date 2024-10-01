<?php

// models/Database.php
class Database {
    private $host = DB_HOST;
    private $db_name = DB_NAME;
    private $username = DB_USER;
    private $password = DB_PASS;
    public $conn;

    public function connect() {
        $this->conn = null;

        // Intentar conectarse a la base de datos
        $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->db_name);

        // Verificar si hay errores en la conexión
        if (mysqli_connect_errno()) {
            echo 'Connection Error: ' . mysqli_connect_error();
            return null;
        }

        return $this->conn;
    }
}
?>
