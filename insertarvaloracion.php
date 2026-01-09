<?php
session_start();
require_once("conexion.php");

if (!isset($_SESSION['u'])) {
    header("Location: iniciarsesion.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre_comenta = $_SESSION['u']; 
    $comentario = $_POST['comentario'] ?? '';
    $estrellas = (int)($_POST['valoracion'] ?? 0);
    $libro_id = (int)($_POST['libro_id'] ?? 0);

    $sql = "INSERT INTO comentarios (nombre, comentario, estrellas, libro_id) VALUES (?, ?, ?, ?)"; 
    $consulta = $con->prepare($sql);
    
    $consulta->bind_param("ssii", $nombre_comenta, $comentario, $estrellas, $libro_id);
    
    if ($consulta->execute()) {
        $consulta->close();
        $con->close();
        
        if ($libro_id > 0) {
            header("Location: detalle.php?id=" . $libro_id);
        } else {
            header("Location: index.php");
        }
        exit();

    } else {
        $consulta->close();
        $con->close();
        die("Error al añadir la valoración."); 
    }
} else {
    header("Location: index.php");
    exit();
}

$con->close(); 
?>