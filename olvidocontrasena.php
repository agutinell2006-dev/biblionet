<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
    <link rel="stylesheet" href="css/registro.css">
</head>
<?php require_once ("header.php");?>
<body>
<div class="textoregistro">Recuperar contraseña</div>
    <div class="formulario">
        <form action="PHPMailer-master/contrasena.php" method="POST">   
            <div class="datos_personales ">
                <div class="dato">
                    <label for="correo">Escribe tu correo: </label> 
                    <input id="correo" type="email" name="correo" placeholder="Tu correo">
                </div>
                <div class="enviar">
                    <input class="enviar2" type="submit" value="Enviar">
                </div>
</body>
</html>