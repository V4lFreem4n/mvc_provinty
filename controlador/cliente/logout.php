<?php
session_start();
session_destroy();
session_unset(); 
header("Location: ../../public/cliente-general-eventos.php");
exit();