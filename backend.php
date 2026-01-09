<?php
require_once("conexion.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $usuario=$_POST['usuario'];
    $contrasena=$_POST['contrasena'];
    $correo=$_POST['email'];

    // lo convierte en JSON
    $servicios= json_encode($_POST['servicios']);
    $sexo=($_POST['sexo']);

    $sql = "INSERT INTO datos (usuarios,contrasena,correo) VALUES ('$usuario','$contrasena')";
  
    if ($con->query($sql) == TRUE) {
        header("Location: iniciarsesion.php");   
    }
else{
    echo "Error al insertar datos: ". $con-> error;
}
}
$con->close();
?>