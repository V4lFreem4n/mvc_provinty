<?php
session_start();
session_destroy();
session_unset(); 
header("Location: ../../public/login-trabajadores.php");
exit();