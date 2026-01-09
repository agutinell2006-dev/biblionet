<?php
session_start(); 

require_once("conexion.php");

if (!isset($_SESSION['u']) || $_SESSION['user_rol'] !== 'admin') { 
    header("Location: index.php"); 
    exit();
}

$user_id = (int)($_GET['id'] ?? 0);

if (!$user_id) {
    header("Location: usuarios.php");
    exit();
}

$stmt_select = $con->prepare("SELECT usuarios, rol FROM datos WHERE id = ?");
$stmt_select->bind_param("i", $user_id);
$stmt_select->execute();
$resultado = $stmt_select->get_result();
$usuario_a_editar = $resultado->fetch_assoc();

if (!$usuario_a_editar) {
    header("Location: usuarios.php");
    exit();
}
$stmt_select->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nuevo_rol'])) {
    $nuevo_rol = $_POST['nuevo_rol'];
        
    if ($nuevo_rol !== 'admin' && $nuevo_rol !== 'usuario') {
        $error = "Rol no válido.";
    } else {
        $update_stmt = $con->prepare("UPDATE datos SET rol = ? WHERE id = ?");
        $update_stmt->bind_param("si", $nuevo_rol, $user_id);
        
        if ($update_stmt->execute()) {
            $_SESSION['mensaje_exito'] = "Rol de " . htmlspecialchars($usuario_a_editar['usuarios']) . " actualizado a " . $nuevo_rol;
            header("Location: usuarios.php");
            exit();
        } else {
            $error = "Error al actualizar el rol."; 
        }
        $update_stmt->close();
    }
}
$con->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Rol de Usuario</title>
    <link rel="stylesheet" href="css/editar_rol.css"> 
</head>
<body>
    <?php require_once('header.php'); ?>
    
    <h1>Editar Rol de: <?= htmlspecialchars($usuario_a_editar['usuarios']) ?></h1>
    
    <div class="form-editar-rol">
        <?php if (isset($error)): ?>
            <p style='color:red;'>Error: <?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form action="editar_rol.php?id=<?= $user_id ?>" method="POST">
            
            <label for="rol_actual_display">Rol actual:</label>
            <p id="rol_actual_display"><?= htmlspecialchars($usuario_a_editar['rol']) ?></p>
            
            <label for="nuevo_rol">Selecciona el nuevo rol:</label>
            <select id="nuevo_rol" name="nuevo_rol" required>
                <option value="admin" <?= ($usuario_a_editar['rol'] === 'admin') ? 'selected' : '' ?>>Admin</option>
                <option value="usuario" <?= ($usuario_a_editar['rol'] === 'usuario') ? 'selected' : '' ?>>Usuario</option>
            </select>
            
            <button type="submit">Cambiar Rol</button>
        </form>
    </div>
</body>
</html>