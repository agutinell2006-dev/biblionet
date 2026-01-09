<?php
session_start();
require_once("conexion.php"); 

$errores = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $usuario = htmlspecialchars(trim($_POST['usuario'] ?? ''));
    $contrasena_plana = $_POST['contrasena'] ?? '';
    $correo = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $acepto_terminos = isset($_POST['suscrito']);
    
    if (!$acepto_terminos) {
        $errores[] = "Debe aceptar los Términos y Condiciones para registrarse.";
    }

    if (strlen($usuario) == 0) {
        $errores[] = "El campo usuario no puede estar vacío.";
    }
    if (strlen($contrasena_plana) < 8 || strlen($contrasena_plana) > 15) {
        $errores[] = "La contraseña debe tener entre 8 y 15 caracteres.";
    }
    if (!preg_match('/[A-Z]/', $contrasena_plana) || !preg_match('/[0-9]/', $contrasena_plana)) {
        $errores[] = "La contraseña debe tener al menos una mayúscula y un número.";
    }
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El formato del correo electrónico no es válido.";
    }

    if (empty($errores)) {

        $stmt_check = $con->prepare("SELECT id FROM datos WHERE usuarios = ? OR correo = ?");
        $stmt_check->bind_param("ss", $usuario, $correo);
        $stmt_check->execute();
        $stmt_check->store_result();
        
        if ($stmt_check->num_rows > 0) {
            $errores[] = "El nombre de usuario o el correo electrónico ya están registrados.";
        } else {

            $contrasena_hashed = password_hash($contrasena_plana, PASSWORD_DEFAULT);
            $rol_por_defecto = 'usuario';

            $sql = "INSERT INTO datos (usuarios, contrasena, correo, rol) VALUES (?, ?, ?, ?)";
            $consulta = $con->prepare($sql);
            $consulta->bind_param("ssss", $usuario, $contrasena_hashed, $correo, $rol_por_defecto);
            
            if ($consulta->execute()) {
                header("Location: iniciarsesion.php");
                exit;
            } else {
                $errores[] = "Error al insertar datos: " . $con->error;
            }
        }
        $stmt_check->close();
    }
}
$con->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro | Biblionet</title>
    <link rel="stylesheet" href="css/registro.css">
</head>
<body>

<?php require_once('header.php');?>    
    <div class="textoregistro">Registro</div>

    <?php
    if (!empty($errores)) {
        echo "<div class='error-box'>";
        foreach ($errores as $error) {
            echo "<div>" . htmlspecialchars($error) . "</div>";
        }
        echo "</div>";
    }
    ?>

    <div class="formulario">
        <form action="registro.php" method="POST"> 
            <div class="datos_personales ">
                
                <div class="dato">
                    <label for="usuario">Escribe tu usuario: </label> 
                    <input id="usuario" name="usuario" type="text" placeholder="Tu usuario" required
                    value="<?php if (isset($_POST['usuario'])) echo htmlspecialchars($_POST['usuario']); ?>">
                </div>

                <div class="dato">
                    <label for="contrasena">Escribe tu contraseña: </label> 
                    <div class="inputconojo">
                        <input id="contrasena" name="contrasena" placeholder="Entre 8-15 caracteres, Mayúscula y un Número" type="password" required
                        value="">
                        <img id="img-contrasena" src="js/img/ojocerrado.png" onclick="cambiar()" alt="Mostrar/Ocultar contraseña">
                    </div>
                </div>
  
                <div class="dato"> 
                    <label class="clasemail" for="email">Escribe tu correo: </label>
                    <input id="email" name="email" type="email" placeholder="Tu correo" required
                    value="<?php if (isset($_POST['email'])) echo htmlspecialchars($_POST['email']); ?>">
                </div>
            </div> 
            
            <div class="terminos">
                <div class="linea-aceptacion">
                    <input id="suscrito" name="suscrito" type="checkbox" value="aceptado"
                    <?php if (isset($_POST['suscrito'])) echo 'checked'; ?>>
                    
                    <label for="suscrito">Acepto los Términos y Condiciones y la Política de Privacidad.</label>
                </div>
                
                <div class="botones-legales">
                    <a href="terminos.html" target="_blank" class="boton-legal">
                        Ver Términos
                    </a>
                    
                    <a href="privacidad.html" target="_blank" class="boton-legal">
                        Ver Política de Privacidad
                    </a>
                </div>
            </div>
            
            <div class="tienescuenta">
                <label for="tienescuenta">¿Ya tienes cuenta? <a href="iniciarsesion.php">Iniciar sesión</label>
            </div>
            
            <div class="enviar">
                <input class="enviar2" type="submit" value="Registrarse">
            </div>
        </form>
    </div>
    
    <script src="js/ojo.js"></script>
</body>
</html>