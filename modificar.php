<?php
session_start(); 
require_once('conexion.php');

if (!isset($_SESSION['u']) || $_SESSION['user_rol'] !== 'admin') {
    header("Location: index.php"); 
    exit();
}

$id = (int)($_GET['id'] ?? 0); 

if ($id === 0) {
    header("Location: usuarios.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $usuario = $_POST['usuario'];
    $correo = $_POST['email'];
    $contrasena_nueva = $_POST['contrasena']; 

    if (!empty($contrasena_nueva)) {
        $contrasena_hashed = password_hash($contrasena_nueva, PASSWORD_DEFAULT);
        $sql = "UPDATE datos SET usuarios=?, correo=?, contrasena=? WHERE id=?";
        $consulta = $con->prepare($sql);
        $consulta->bind_param("sssi", $usuario, $correo, $contrasena_hashed, $id);
    } else {
        $sql = "UPDATE datos SET usuarios=?, correo=? WHERE id=?";
        $consulta = $con->prepare($sql);
        $consulta->bind_param("ssi", $usuario, $correo, $id);
    }

    if ($consulta->execute()) {
        header("Location: usuarios.php");
        exit();
    } else {
        $_SESSION['error_modificar'] = "Error al actualizar el usuario.";
        header("Location: modificar.php?id=" . $id);
        exit();
    }
}

$sql = "SELECT usuarios, correo FROM datos WHERE id = ?";
$consulta_select = $con->prepare($sql);
$consulta_select->bind_param("i", $id);
$consulta_select->execute();
$resultado = $consulta_select->get_result();

if ($resultado->num_rows === 0) {
    header("Location: usuarios.php");
    exit();
}

$fila = $resultado->fetch_assoc();
$consulta_select->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Usuario</title>
    <link rel="stylesheet" href="css/registro.css"> 
</head>
<body>
<?php 
require_once('header.php'); 

if (isset($_SESSION['error_modificar'])):
?>
    <div style="color: red; text-align: center;">
        <?= htmlspecialchars($_SESSION['error_modificar']) ?>
    </div>
<?php
    unset($_SESSION['error_modificar']);
endif;
?>

<div class="textoregistro">Modificar Usuario</div>
<div class="formulario">
    <form action="modificar.php?id=<?= $id ?>" method="POST">
        <div class="datos_personales">
            <div class="dato">
                <label for="usuario">Usuario: </label>
                <input id="usuario" name="usuario" type="text" value="<?= htmlspecialchars($fila['usuarios']) ?>" required>
            </div>
            <div class="dato">
                <label for="contrasena">Contraseña (dejar vacío para no cambiar): </label>
                <input id="contrasena" name="contrasena" type="password" value="">
            </div>
            <div class="dato">
                <label for="email">Correo: </label>
                <input id="email" name="email" type="email" value="<?= htmlspecialchars($fila['correo']) ?>" required>
            </div>

            <div class="enviar">
                <input class="enviar2" type="submit" value="Modificar Usuario">
            </div>
        </div>
    </form>
</div>
</body>
</html>

<?php $con->close(); ?>