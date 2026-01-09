<?php 
session_start(); 

if (isset($_SESSION['u'])) { 
    header("Location: index.php"); 
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title> 
    <link rel="stylesheet" href="css/iniciarsesion.css">
    <link rel="stylesheet" href="css/header.css">
</head>

<body>

<?php require_once ('header.php'); ?>

<?php
$mensajes = [
    'exito_recuperacion' => 'success-message',
    'error_recuperacion' => 'error-message',
    'login_error' => 'error-message'
];

foreach ($mensajes as $key => $class):
    if (isset($_SESSION[$key])):
?>
        <div class="session-message <?= $class ?>">
            <?= htmlspecialchars($_SESSION[$key]) ?>
        </div>
<?php 
        unset($_SESSION[$key]);
    endif;
endforeach; 
?>

    <div class="formulario">
        <form action="escribir.php" method="POST"> 
            <div class="datos_personales">

                <div class="dato">
                    <label for="usuario">Escribe tu usuario: </label> 
                    <input id="usuario" name="usuario" placeholder="Tu usuario" type="text" required spellcheck="false" 
                           value="<?= htmlspecialchars($_COOKIE['usuario'] ?? '') ?>">
                </div>

                <div class="dato">
                    <label for="contrasena">Escribe tu contraseña: </label> 
                    <div class="inputconojo">
                        <input id="contrasena" 
                               name="contrasena" 
                               placeholder="Tu contraseña" 
                               type="password" 
                               required 
                               spellcheck="false" 
                               value="<?= htmlspecialchars($_COOKIE['contrasena'] ?? '') ?>"> 
                        <button type="button" id="togglePassword" class="toggle-password-btn">
                            <i class="fa-solid fa-eye" aria-hidden="true"></i>
                        </button>
                    </div>
                </div> 

                <div class="notienescuenta">
                    ¿Aún no tienes cuenta? <a href="registro.php">Regístrate</a>
                </div>

                <div class="olvidocontrasena">
                    <a href="olvidocontrasena.php">He olvidado mi contraseña</a>
                </div>

                <div>
                    <button class="crear" type="submit">Iniciar</button>
                </div>
            </div> 

            <script>
                const togglePassword = document.getElementById('togglePassword');
                const passwordInput = document.getElementById('contrasena');
                const eyeIcon = togglePassword.querySelector('i');

                togglePassword.addEventListener('click', function () {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);

                    eyeIcon.classList.toggle('fa-eye');
                    eyeIcon.classList.toggle('fa-eye-slash');
                });
            </script>
        </form>
    </div>
</body>
</html>