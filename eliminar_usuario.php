<?php
session_start();
require_once("conexion.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);


    if (isset($_SESSION['i']) && $_SESSION['i'] == $id) {
        session_unset();
        session_destroy();
    }

    $sql = "DELETE FROM datos WHERE id = $id";

    if ($con->query($sql) === TRUE) {
        header("Location: usuarios.php");
        exit();
    } else {
        echo "Error al eliminar el usuario: " . $con->error;
    }
} else {
    echo "ID de usuario no proporcionado.";
}

$con->close();
?>