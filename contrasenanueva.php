<?php
require_once('conexion.php');
require_once('header.php');

if (isset($_GET['token'])) {
    $elToken = $_GET['token'];
    $consulta = $con->prepare("SELECT * FROM datos WHERE token=? AND token_temporal > NOW()");
    $consulta->bind_param("s", $elToken);
    $consulta->execute();
    $resultado = $consulta->get_result();
    $errores = [];
    if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['contrasena'])){
        $password=htmlspecialchars($_POST['contrasena']);

        if (strlen($password)<4){
            $errores[]="La contraseña debe tener como mínimo 4 digitos";
        }
        if (strlen($password)>15){
            $errores[]="La contraseña debe tener como máximo 15 digitos";
        }
        if (!preg_match('/[A-Z]/',$password) || !preg_match('/[0-9]/',$password)){
            $errores[]="La contraseña debe tener mayúsculas y números";
        }   
    if (count($errores) === 0) { 
        $lewandowski = password_hash($password, PASSWORD_DEFAULT);

        $consult = $con->prepare("UPDATE datos SET contrasena=?, token=NULL, token_temporal=NULL WHERE token=?");
        $consult->bind_param("ss", $lewandowski, $elToken);
        $consult->execute();
        echo "<script>window.location.href='iniciarsesion.php';</script>";
        exit;
    }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/contrasenanueva.css">
</head>
<body>
<form action="contrasenanueva.php?token=<?php echo $elToken;?>" class="formulario" method="POST">   

                <div class="dato">
                    <label for="contrasena">Escribe tu contraseña: </label> 
                    <div class="inputconojo">
                        <input id="contrasena" name="contrasena" placeholder="Tu contraseña" type="password" required title="Escribe algo" spellcheck="false" value="<?php if(isset($_COOKIE['contrasena'])) echo $_COOKIE['contrasena']; ?>">
                        
                    </div>
                </div>
        <?php
           if (!empty($errores)){
                echo "<div class='error'>";
                foreach ($errores as $error){
                    echo "<div>$error</div>";
                }
                echo "</div>";
            }
        ?>
            <div class="enviar">
                <input class="enviar2" type="submit" value="Registrarse">
            </div>
    </form>
</body>
</html>
</body>
</html>
<?php
        } else {
            echo 'El correo no es correcto';
        }
?>