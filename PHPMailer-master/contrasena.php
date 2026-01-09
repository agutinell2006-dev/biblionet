<?php
session_start(); // Aseguramos la sesión para manejar la redirección de errores
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';
require_once '../conexion.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $gemeil = $_POST['correo'];
    $elToken = bin2hex(random_bytes(16));
    
    // El token expira en 11000 segundos (3 horas y 3 minutos)
    $tiempo = date('Y-m-d H:i:s', time() + 11000); 

    // 1. Almacenar Token y Tiempo en la BD
    $consulta = $con->prepare("UPDATE datos SET token=?, token_temporal=? WHERE correo=?");
    $consulta->bind_param("sss", $elToken, $tiempo, $gemeil);
    $consulta->execute();
    
    // Comprobar si el correo existe antes de enviar el email
    if ($consulta->affected_rows === 0) {
        $_SESSION['error_recuperacion'] = "El correo no está registrado.";
        header("Location: ../iniciarsesion.php");
        exit;
    }

    $mail = new PHPMailer(true);
    try {
        // Configuración de Servidor SMTP (Gmail/Google)
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'amolin340@gmail.com';
        
        // 🚨 CORRECCIÓN 1: Quitar espacios de la App Password
        $mail->Password = 'inag ylyw nqpc ltax'; 
        
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
        $mail->Port = 465;

        // Remitente y Destinatario
        $mail->setFrom('amolin340@gmail.com', 'biblionet');
        $mail->addAddress($gemeil);

        // 🔑 CORRECCIÓN 2: Usar la ruta de proyecto correcta (proyecto_final1)
        $enlace_token = 'http://localhost/proyecto_final1copia/contrasenanueva.php?token=' . $elToken;

        // Contenido del Email
        $mail->isHTML(true);
        $mail->Subject = 'Recupera tu contrasena';
        $mail->Body = "<h1>Atención</h1><div>Para agregar una nueva contraseña haga click <a href='$enlace_token'>aquí</a></div>";
        $mail->AltBody = "Entra en este enlace para recuperar tu contraseña: $enlace_token";
        
        $mail->send();
        
        // Éxito: Redirigir al inicio con un mensaje de éxito (si lo tienes)
        $_SESSION['exito_recuperacion'] = "Se ha enviado un correo electrónico con las instrucciones.";
        header("Location: ../iniciarsesion.php");
        exit;
        
    } catch (Exception $e) {
        // Manejar error con sesión y redirigir
        $_SESSION['error_recuperacion'] = "El mensaje no pudo ser enviado. Por favor, verifica las credenciales de la App Password.";
        header("Location: ../iniciarsesion.php");
        exit;
    }
}
?>