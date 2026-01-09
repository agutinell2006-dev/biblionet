<?php
session_start();
require_once("conexion.php");

$usuario_ingresado = $_POST['usuario'] ?? '';
$contrasena_ingresada = $_POST['contrasena'] ?? '';

$stmt = $con->prepare("SELECT id, usuarios, contrasena, rol FROM datos WHERE usuarios = ?");
$stmt->bind_param("s", $usuario_ingresado);
$stmt->execute();
$resultado = $stmt->get_result();

$error_message = "Usuario o contraseña incorrectos."; 

if ($fila = $resultado->fetch_assoc()) {
    
    if (password_verify($contrasena_ingresada, $fila['contrasena'])) {
        
        $_SESSION['i'] = $fila['id'];
        $_SESSION['u'] = $fila['usuarios'];
        $_SESSION['user_rol'] = $fila['rol']; 
        
        $expiracion = time() + (86400 * 1); 
        setcookie('usuario', $usuario_ingresado, $expiracion, "/");
        setcookie('contrasena', $contrasena_ingresada, $expiracion, "/"); 

        session_regenerate_id(true);

        header("Location: index.php");
        exit();
    }
}

$_SESSION['login_error'] = $error_message;
header("Location: iniciarsesion.php");
exit();

$stmt->close();
$con->close();
?>