<?php
$contrasena = "admin123456789**";
$hash = password_hash($contrasena, PASSWORD_DEFAULT);
echo $hash;
?>