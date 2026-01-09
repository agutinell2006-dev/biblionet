<?php
// Configuración de la base de datos
define('SERVIDOR','localhost'); 
define('USUARIO','root'); 
define('PASSWORD',''); 
define('BASEDEDATOS','biblionet');

$con = new mysqli(SERVIDOR, USUARIO, PASSWORD, BASEDEDATOS);

if ($con->connect_error) {
    die("Error de conexión a la base de datos: " . $con->connect_error);
}
?>