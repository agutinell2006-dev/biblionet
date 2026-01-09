<?php
session_start(); 
require_once("conexion.php");

if (!isset($_SESSION['u']) || $_SESSION['user_rol'] !== 'admin') {
    header("Location: index.php");
    exit();
}

$sql = "SELECT id, usuarios, correo FROM datos"; 
$resultado = $con->query($sql);
$con->close(); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="css/usuarios.css">
</head>
<body>
<?php 
require_once ('header.php');
?>
    <div class="titulo">Lista de usuarios</div>

    <?php if (isset($_SESSION['mensaje_exito'])): ?>
        <div style="color: green; text-align: center; padding: 10px;">
            <?= htmlspecialchars($_SESSION['mensaje_exito']) ?>
        </div>
        <?php unset($_SESSION['mensaje_exito']); ?>
    <?php endif; ?>

    <div class="usuarios-container">
        <div class="header_caja">
            <div>Usuario</div>
            <div>Correo</div>
            <div>Acciones</div>
        </div>
        
        <?php if ($resultado->num_rows > 0): 
            while($fila = $resultado->fetch_assoc()): ?>
                <div class="cajausuario">
                    <div><?= htmlspecialchars($fila["usuarios"]); ?></div>
                    <div><?= htmlspecialchars($fila["correo"]); ?></div>

                    <div class="acciones">
                        <a href="modificar.php?id=<?= $fila['id']; ?>" class="modificar" title="Editar Información">
                            <img src="img/modificar.png" alt="Modificar" class="modificarimagen"> 
                        </a>

                        <a href="editar_rol.php?id=<?= $fila['id']; ?>" class="editar-rol" title="Editar Rol">
                            <img src="img/engranage.png" alt="Editar Rol" class="editarrolimagen"> 
                        </a>

                        <a href="eliminar_usuario.php?id=<?= $fila['id']; ?>" class="eliminar" onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?');">✖</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="text-align: center;">No hay usuarios registrados</p>
        <?php endif; ?>
    </div>
</body>
</html>