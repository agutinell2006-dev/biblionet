<?php
session_start(); 

if (isset($_POST['cerrar_sesion'])) {
    session_unset(); 
    session_destroy(); 
    header('Location: index.php'); 
    exit();
}
?>