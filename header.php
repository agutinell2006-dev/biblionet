<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
</head>
<body>

<div class="todo5">
    <a href="index.php" class="logo">
        <img src="img/biblionet.png" alt="Biblionet Logo" class="logo-image">
    </a>

    <?php 
    if (isset($_SESSION['i'])):
        $pagina_actual = basename($_SERVER['PHP_SELF']); 
    ?>
        <div class="aceituna">
            <nav>
                <a href="index.php" class="<?= ($pagina_actual == 'index.php') ? 'active' : '' ?>">Inicio</a>  
                
                <?php 
                if (isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'admin'): 
                ?>
                    <a href="usuarios.php" class="<?= ($pagina_actual == 'usuarios.php') ? 'active' : '' ?>">Usuarios</a>
                <?php endif; ?>
            </nav>
        </div>
        
        <div class="titulousuario">
            <?= "¡Bienvenid@, " . htmlspecialchars($_SESSION['u']) . "!" ?>
        </div>
    <?php endif; ?>

    <div class="tituloycerrar">
        <div class="iniciarsesion">
            <?php if (!isset($_SESSION['i'])): ?>
                <a href="iniciarsesion.php">
                    <button class="crear">Iniciar sesión</button>
                </a>
            <?php else: ?>
                <form method="post" action="cerrarsesion.php">
                    <button class="crear" type="submit" name="cerrar_sesion">Cerrar sesión</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>