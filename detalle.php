<?php
session_start();

if (!isset($_SESSION['u'])) {
    header("Location: iniciarsesion.php");
    exit();
}
require_once('conexion.php');
if (!isset($_GET['id'])) {
    die("Error: No se especificó ningún libro.");
}
$id = intval($_GET['id']);

$libros = [ 
    1 => ["imagen" => "img/sangre_fria.jpg", "titulo" => "A Sangre Fría", "descripcion" => "A sangre fría de Truman Capote es una novela de no ficción que narra el brutal asesinato de la familia Clutter en Holcomb, Kansas, en 1959, a manos de Perry Smith y Dick Hickock...", "autor" => "Truman Capote", "nombre_archivo" => "a-sangre-fria.pdf", "categoria" => "Novela"],
    2 => ["imagen" => "img/frankenstein.jpg", "titulo" => "Frankenstein", "descripcion" => "En la novela Frankenstein de Mary Shelley, el científico Víctor Frankenstein crea una criatura a partir de partes de cadáveres, pero la abandona al horrorizarse de su aspecto...", "autor" => "Mary Shelley", "nombre_archivo" => "Frankenstein.pdf", "categoria" => "Terror"],
    3 => ["imagen" => "img/dracula.jpg", "titulo" => "Drácula", "descripcion" => "Drácula de Bram Stoker narra el viaje del abogado Jonathan Harker al castillo del Conde Drácula en Transilvania para cerrar una transacción inmobiliaria...", "autor" => "Bram Stoker", "nombre_archivo" => "dracula.pdf", "categoria" => "Terror"],
    4 => ["imagen" => "img/watchmen.jpg", "titulo" => "Watchmen", "descripcion" => "Watchmen es una novela gráfica que, ambientada en una realidad alternativa de 1985, narra la investigación del asesinato del Comediante por el vigilante Rorschach...", "autor" => "Alan Moore", "nombre_archivo" => "watchmen.pdf", "categoria" => "Acción"],
    5 => ["imagen" => "img/1984.jpg", "titulo" => "1984", "descripcion" => "1984 de George Orwell es una novela distópica que se sitúa en un Londres bajo el control de un régimen totalitario representado por el Gran Hermano...", "autor" => "George Orwell", "nombre_archivo" => "1984.pdf", "categoria" => "Ciencia ficción"],
    6 => ["imagen" => "img/principito.jpg", "titulo" => "El principito", "descripcion" => "El Principito narra el encuentro entre un piloto varado en el desierto del Sahara y un niño de otro planeta que le pide que dibuje un cordero...", "autor" => "Antoine de Saint-Exupéry", "nombre_archivo" => "el principito.pdf", "categoria" => "Fábula"],
    7 => ["imagen" => "img/nada.jpg", "titulo" => "Nada", "descripcion" => "La sinopsis del libro Nada de Carmen Laforet describe la llegada de la joven Andrea a la Barcelona de la posguerra para estudiar Letras...", "autor" => "Carmen Laforet", "nombre_archivo" => "nada.pdf", "categoria" => "Ficción"],
    8 => ["imagen" => "img/Camino.jpg", "titulo" => "Camino", "descripcion" => "El camino, de Miguel Delibes, narra los recuerdos de Daniel, el Mochuelo, un niño de once años la noche antes de partir a estudiar a la ciudad...", "autor" => "Miguel Delibes", "nombre_archivo" => "el camino.pdf", "categoria" => "Ficción"],
    9 => ["imagen" => "img/perdida.jpg", "titulo" => "Perdida", "descripcion" => "Perdida de Gillian Flynn narra la desaparición de Amy Dunne, la esposa de Nick Dunne, en su quinto aniversario de bodas...", "autor" => "Gillian Flynn", "nombre_archivo" => "perdida.pdf", "categoria" => "Novela"],
    10 => ["imagen" => "img/salvaje.jpg", "titulo" => "Salvaje", "descripcion" => "Salvaje narra el viaje en solitario de Cheryl Strayed por el Sendero de la Cresta del Pacífico (PCT) tras la muerte de su madre...", "autor" => "Cheryl Strayed", "nombre_archivo" => "Salvaje.pdf", "categoria" => "Aventura"],
    11 => ["imagen" => "img/elantris.jpeg", "titulo" => "Elantris", "descripcion" => "Elantris de Brandon Sanderson es una novela de fantasía que narra la caída de la ciudad de Elantris, una metrópolis mágica cuyos habitantes fueron transformados en seres decadentes...", "autor" => "Brandon Sanderson", "nombre_archivo" => "Elantris.pdf", "categoria" => "Fantasía"],
    12 => ["imagen" => "img/el_nombre_del_viento.jpeg", "titulo" => "El nombre del viento", "descripcion" => "El nombre del viento de Patrick Rothfuss narra la historia de Kvothe, un legendario músico, mago y asesino que cuenta su vida desde la infancia...", "autor" => "Patrick Rothfuss", "nombre_archivo" => "El nombre del viento.pdf", "categoria" => "Fantasía"],
    13 => ["imagen" => "img/seda.jpeg", "titulo" => "Seda", "descripcion" => "Seda de Alessandro Baricco narra el viaje del comerciante de gusanos de seda Hervé Joncour a Japón a finales del siglo XIX...", "autor" => "Alessandro Baricco", "nombre_archivo" => "Seda.pdf", "categoria" => "Novela"],
    14 => ["imagen" => "img/lolita.png", "titulo" => "Lolita", "descripcion" => "Lolita de Vladimir Nabokov es narrada por Humbert Humbert, un profesor de mediana edad obsesionado con las 'nínfulas'...", "autor" => "Vladimir Nabokov", "nombre_archivo" => "lolita.pdf", "categoria" => "Novela"],
    15 => ["imagen" => "img/los_pilares_de_la_tierra.jpeg", "titulo" => "Los pilares de la tierra", "descripcion" => "Los Pilares de la Tierra de Ken Follett es una novela histórica ambientada en el siglo XII en Inglaterra...", "autor" => "Ken Follett", "nombre_archivo" => "Los-pilares-de-la-tierra.pdf", "categoria" => "Novela Histórica"],
    16 => ["imagen" => "img/la_ilusion_del_tiempo.jpeg", "titulo" => "La ilusión del tiempo", "descripcion" => "La Ilusión del Tiempo de José A. López Guerrero es un ensayo que explora el concepto del tiempo desde múltiples perspectivas: física, biológica, cosmológica y filosófica...", "autor" => "José A. López Guerrero", "nombre_archivo" => "las_ilusiones_del_tiempo.pdf", "categoria" => "Ensayo"],
    17 => ["imagen" => "img/cosmos.jpeg", "titulo" => "Cosmos", "descripcion" => "Cosmos de Carl Sagan es una obra de divulgación científica que explora la historia de la astronomía, la evolución del universo, la vida y la ciencia...", "autor" => "Carl Sagan", "nombre_archivo" => "cosmos.pdf", "categoria" => "Ciencia"],
    18 => ["imagen" => "img/bomarzo.jpeg", "titulo" => "Bomarzo", "descripcion" => "Bomarzo de Manuel Mujica Lainez es una novela que narra la vida del duque Pier Francesco Orsini, un noble jorobado del Renacimiento italiano...", "autor" => "Manuel Mujica Lainez", "nombre_archivo" => "bomarzo.pdf", "categoria" => "Novela Histórica"],
    19 => ["imagen" => "img/demonios.jpeg", "titulo" => "Demonios", "descripcion" => "Los Demonios de Fiódor Dostoievski es una novela política que retrata la inestabilidad social en la Rusia del siglo XIX...", "autor" => "Fiódor Dostoievski", "nombre_archivo" => "Los_demonios.pdf", "categoria" => "Novela"],
    20 => ["imagen" => "img/soldados_salamina.jpeg", "titulo" => "Soldados de Salamina", "descripcion" => "Soldados de Salamina de Javier Cercas narra la búsqueda de la escritora y periodista Lola para investigar un episodio de la Guerra Civil Española...", "autor" => "Javier Cercas", "nombre_archivo" => "Soldados Salamina.pdf", "categoria" => "Novela Histórica"]
];

$libro = $libros[$id] ?? null; 

if (!$libro) {
    die("Error: Libro no encontrado.");
}

$titulo = htmlspecialchars($libro['titulo'] ?? 'Título Desconocido');
$autor = htmlspecialchars($libro['autor'] ?? 'Autor Desconocido');
$imagen = htmlspecialchars($libro['imagen']);
$descripcion = htmlspecialchars($libro['descripcion']);
$tags = ['Ficción / Romance', 'Narrativa moderna', 'Fiction']; 

$media = 0;
$total_votos = 0;
$libro_id_seguro = $con->real_escape_string($id);

$sql_avg = "SELECT ROUND(AVG(estrellas)) AS media, COUNT(id) AS total_votos FROM comentarios WHERE libro_id = '$libro_id_seguro'";
$resultado_avg = $con->query($sql_avg);

if ($resultado_avg && $fila_avg = $resultado_avg->fetch_assoc()) {
    $media = (int)$fila_avg['media'];
    $total_votos = (int)$fila_avg['total_votos'];
}

$sql = "SELECT `nombre`, `comentario`, `estrellas` FROM `comentarios` WHERE `libro_id` = '$libro_id_seguro' ORDER BY `id` DESC";
$result = $con->query($sql);

if (!$result) {
    $result = (object)['num_rows' => 0, 'fetch_assoc' => fn() => null]; 
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $titulo ?></title>
    <link rel="stylesheet" href="css/detalle.css">
</head>
<body>

<?php require_once('header.php'); ?>

<div class="detalle-container">

    <a href="index.php" class="close-button">&times;</a>

    <div class="detalle-imagen">
        <img src="<?= $imagen ?>" alt="Portada de <?= $titulo ?>">
    </div>

    <div class="detalle-info">

        <h1><?= $titulo ?></h1>
        <p class="autor"><?= $autor ?></p>

        <div style="margin-bottom: 20px;">
            <?php 
            for ($i = 1; $i <= 5; $i++):
                echo '<span style="color: ' . ($i <= $media ? 'gold' : '#ccc') . '; font-size: 1.2em;">&#9733;</span>';
            endfor;
            ?>
            <span style="margin-left: 15px; color: #999;">(<?= $total_votos ?> votos)</span>
        </div>

        <div class="acciones">
            <a href="descarga_libro.php?libro_id=<?= $id ?>" class="btn-principal btn-prestar">DESCARGAR LIBRO</a>
        </div>

        <div class="descripcion-texto">
            <?= nl2br($descripcion) ?>
        </div>

        <div style="margin-top: 25px;">
            <?php foreach ($tags as $tag): ?>
                <span class="etiqueta-tag"><?= htmlspecialchars($tag) ?></span>
            <?php endforeach; ?>
        </div>

    </div>
</div>

<div class="comentarios-seccion-general">
    <div class="dejaropinion">Deja tu opinión</div>

    <form class="valoraciones" action="insertarvaloracion.php" method="POST">
        <textarea name="comentario" placeholder="Tu comentario" required maxlength="200"></textarea>
        <div class="estrellas"></div>
        <input type="hidden" name="valoracion" id="valoracion" value="0">
        <button type="submit">Enviar</button>
        <input type="hidden" name="usuario_comenta" value="<?= htmlspecialchars($_SESSION['u']) ?>"> 
        <input type="hidden" name="libro_id" value="<?= $id ?>"> 
    </form>

    <div class="comentarios">
        <h3>Comentarios:</h3>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='comentario'><strong>" . htmlspecialchars($row['nombre']) . ":</strong> " . htmlspecialchars($row['comentario']);
                
                $estrellas = (int)$row['estrellas'];
                echo "<div>";
                for ($i = 0; $i < 5; $i++) {
                    $img = ($i < $estrellas) ? 'estrelladorada.png' : 'estrellagris.png';
                    echo "<img src='js/img/$img' class='estrella' />";
                }
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No hay comentarios aún.</p>";
        }
        $con->close();
        ?>
    </div>
</div>
<script src="js/codigoestrellas.js"></script> 

</body>
</html>