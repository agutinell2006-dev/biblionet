<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Online</title>
    <link rel="stylesheet" href="css/productos.css">
    <link rel="stylesheet" href="css/header.css"> 
</head>
<body>

<?php require_once('header.php'); ?>

<?php
$libros = [
    ['titulo' => 'Sangre Fría', 'imagen' => 'img/sangre_fria.jpg', 'descripcion' => 'A sangre fría...', 'categoria' => 'Novela'], 
    ['titulo' => 'Frankenstein', 'imagen' => 'img/frankenstein.jpg', 'descripcion' => 'Crea una criatura...', 'categoria' => 'Fantasía'], 
    ['titulo' => 'Drácula', 'imagen' => 'img/dracula.jpg', 'descripcion' => 'Viaje del abogado Harker...', 'categoria' => 'Fantasía'], 
    ['titulo' => 'Watchmen', 'imagen' => 'img/watchmen.jpg', 'descripcion' => 'Novela gráfica 1985...', 'categoria' => 'Fantasía'], 
    ['titulo' => '1984', 'imagen' => 'img/1984.jpg', 'descripcion' => 'Novela distópica...', 'categoria' => 'Novela'], 
    ['titulo' => 'El principito', 'imagen' => 'img/principito.jpg', 'descripcion' => 'Piloto varado...', 'categoria' => 'Fantasía'], 
    ['titulo' => 'Nada', 'imagen' => 'img/nada.jpg', 'descripcion' => 'Joven Andrea en posguerra...', 'categoria' => 'Novela'], 
    ['titulo' => 'Camino', 'imagen' => 'img/Camino.jpg', 'descripcion' => 'Recuerdos de Daniel...', 'categoria' => 'Historia'], 
    ['titulo' => 'Perdida', 'imagen' => 'img/perdida.jpg', 'descripcion' => 'Desaparición de Amy Dunne...', 'categoria' => 'Novela'], 
    ['titulo' => 'Salvaje', 'imagen' => 'img/salvaje.jpg', 'descripcion' => 'Viaje en solitario de Cheryl Strayed...', 'categoria' => 'Novela'], 
    ['titulo' => 'Elantris', 'imagen' => 'img/elantris.jpeg', 'descripcion' => 'Caída de la ciudad mágica...', 'categoria' => 'Fantasía'], 
    ['titulo' => 'El nombre del viento', 'imagen' => 'img/el_nombre_del_viento.jpeg', 'descripcion' => 'Historia de Kvothe...', 'categoria' => 'Fantasía'], 
    ['titulo' => 'Seda', 'imagen' => 'img/seda.jpeg', 'descripcion' => 'Viaje del comerciante Hervé Joncour...', 'categoria' => 'Novela'], 
    ['titulo' => 'Lolita', 'imagen' => 'img/lolita.png', 'descripcion' => 'Obsesión de Humbert Humbert...', 'categoria' => 'Novela'], 
    ['titulo' => 'Los pilares de la tierra', 'imagen' => 'img/los_pilares_de_la_tierra.jpeg', 'descripcion' => 'Construcción de una catedral gótica...', 'categoria' => 'Novela Histórica'], 
    ['titulo' => 'La ilusión del tiempo', 'imagen' => 'img/la_ilusion_del_tiempo.jpeg', 'descripcion' => 'Ensayo sobre el concepto del tiempo...', 'categoria' => 'Ensayo'], 
    ['titulo' => 'Cosmos', 'imagen' => 'img/cosmos.jpeg', 'descripcion' => 'Divulgación científica...', 'categoria' => 'Ciencia'], 
    ['titulo' => 'Bomarzo', 'imagen' => 'img/bomarzo.jpeg', 'descripcion' => 'Vida del duque Pier Francesco Orsini...', 'categoria' => 'Novela Histórica'], 
    ['titulo' => 'Demonios', 'imagen' => 'img/demonios.jpeg', 'descripcion' => 'Novela política Rusia siglo XIX...', 'categoria' => 'Novela'], 
    ['titulo' => 'Soldados de Salamina', 'imagen' => 'img/soldados_salamina.jpeg', 'descripcion' => 'Búsqueda del fusilamiento fallido...', 'categoria' => 'Novela Histórica'], 
];

$filtro = $_GET['categoria'] ?? 'Todo';
$libros_filtrados = [];
$id_inicial = 1;

foreach($libros as $index => $libro) {
    $id = $index + $id_inicial;
    $categoria_libro = $libro['categoria'] ?? '';
    
    if ($filtro === 'Todo' || $categoria_libro === $filtro) {
        $libros_filtrados[] = ['id' => $id, 'producto' => $libro];
    }
}
?>

<h2 class="titulo">Libros disponibles</h2>

<div class="categorias">
    <?php
    $categorias_lista = ['Todo', 'Novela', 'Ciencia', 'Historia', 'Fantasía'];
    foreach ($categorias_lista as $cat):
    ?>
        <a href="index.php?categoria=<?= $cat ?>" class="<?= ($filtro == $cat) ? 'activo' : '' ?>"><?= $cat ?></a>
    <?php endforeach; ?>
</div>

<div class="contenedor-productos">
    <div class="productos">
    <?php if(!empty($libros_filtrados)): ?>
        <?php foreach($libros_filtrados as $item): 
            $producto = $item['producto'];
            $id = $item['id'];
            ?>
            <a href="detalle.php?id=<?= $id ?>" class="producto" style="text-decoration:none; color:inherit; cursor:pointer;">
                <img src="<?= $producto['imagen'] ?>" alt="<?= $producto['titulo'] ?>" class="productoimagen">
                <p class="nombre-producto"><?= htmlspecialchars($producto['titulo']) ?></p>
                <p class="categoria-libro"><?= htmlspecialchars($producto['categoria']) ?></p>
            </a>
        <?php endforeach; ?>
    <?php else: ?>
        <p style='padding: 20px; text-align: center;'>No hay libros disponibles en esta categoría.</p>
    <?php endif; ?>
    </div>
</div>

</body>
</html>