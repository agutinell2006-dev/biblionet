<?php
session_start();
require_once('header.php'); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Biblionet</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/iniciarsesion.css">
    <link rel="stylesheet" href="css/bienvenida.css"> 
</head>
<body>

<div class="intro-container">
    
    <header class="hero-section">
        <h1 class="main-title">Bienvenido a Biblionet: Tu Espacio de Lectura Digital</h1>
        <p class="subtitle">Accede a miles de libros al instante y forma parte de nuestra comunidad de lectores.</p>
    </header>

    <section class="features-section">
        <h2>¿Por qué elegir Biblionet?</h2>
        <div class="cards-grid">
            
            <div class="card">
                <i class="fas fa-search icon-card"></i>
                <h3>Amplia Colección</h3>
                <p>Navega y descarga todos los libros disponibles, desde clásicos hasta publicaciones científicas.</p>
            </div>
            
            <div class="card">
                <i class="fas fa-star icon-card"></i>
                <h3>Comunidad Activa</h3>
                <p>Deja tus comentarios y valoraciones para ayudar a otros usuarios a encontrar su próxima lectura.</p>
            </div>
            
            <div class="card">
                <i class="fas fa-file-pdf icon-card"></i>
                <h3>Descarga Directa</h3>
                <p>Todos nuestros libros están disponibles en formato PDF para lectura en cualquier dispositivo.</p>
            </div>
        </div>
    </section>
    
    <section class="go-to-library-section">
        <div class="derechos">* Catálogo educativo. Contenido sujeto a derechos de autor de sus propietarios originales *</div>
        <h2 class="subtitle">¿Listo para comenzar tu aventura?</h2>
        <a href="index.php" class="btn-empezar">Ir a la Galería de Libros</a>
    </section>

</div>

</body>
</html>