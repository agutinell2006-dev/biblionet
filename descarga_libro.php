<?php
session_start();

if (!isset($_SESSION['u'])) {
    header("Location: iniciarsesion.php");
    exit();
}

$id_libro = isset($_GET['libro_id']) ? intval($_GET['libro_id']) : 0;

if ($id_libro <= 0) {
    die("Error: ID de libro no válida.");
}

$libros_data = [
    1 => [
        "nombre" => "A Sangre Fría", 
        "nombre_archivo" => "a-sangre-fria.pdf" 
    ],
    2 => [
        "nombre" => "Frankenstein",
        "nombre_archivo" => "Frankenstein.pdf"
    ],
    3 => [
        "nombre" => "Dracula",
        "nombre_archivo" => "dracula.pdf"
    ],
    4 => [
        "nombre" => "Watchmen",
        "nombre_archivo" => "watchmen.pdf"
    ],
    5 => [
        "nombre" => "1984",
        "nombre_archivo" => "1984.pdf"
    ],
    6 => [
        "nombre" => "El principito",
        "nombre_archivo" => "el principito.pdf"
    ],
    7 => [
        "nombre" => "Nada",
        "nombre_archivo" => "nada.pdf"
    ],
    8 => [
        "nombre" => "Camino",
        "nombre_archivo" => "el camino.pdf"
    ],
    9 => [
        "nombre" => "Perdida",
        "nombre_archivo"=> "perdida.pdf"
    ],  
    10 => [
        "nombre" => "Salvaje",
        "nombre_archivo" => "salvaje.pdf"
    ],
    11 => [
        "nombre" => "Elantris",
        "nombre_archivo" => "Elantris.pdf"
    ],
    12 => [
        "nombre" => "El nombre del viento",
        "nombre_archivo" => "El nombre del viento.pdf"
    ],
    13 => [
        "nombre" => "Seda",
        "nombre_archivo" => "Seda.pdf"
    ],
    14 => [
        "nombre" => "Lolita",
        "nombre_archivo"=> "lolita.pdf"
    ],
    15 => [
        "nombre" => "Los pilares de la tierra",
        "nombre_archivo" => "Los-pilares-de-la-tierra.pdf"
    ],
    16 => [
        "nombre" => "La ilusion del tiempo",
        "nombre_archivo" => "las_ilusiones_del_tiempo.pdf"
    ],
    17 => [
        "nombre" => "Cosmos",
        "nombre_archivo" => "cosmos.pdf"
    ],
    18 => [
        "nombre" => "Bomarzo",
        "nombre_archivo" => "bomarzo.pdf"
    ],
    19 => [
        "nombre" => "Demonios",
        "nombre_archivo" => "Los_demonios.pdf"
    ],
    20 => [
        "nombre" => "Soldados de Salamina",
        "nombre_archivo" => "Soldados Salamina.pdf"
    ]
];

$libro = $libros_data[$id_libro] ?? null;

if (!$libro) {
    header("Location: index.php?error=libro_no_existe");
    exit();
}

$carpeta_archivos = "archivos_libros/"; 
$archivo_a_descargar = $carpeta_archivos . $libro['nombre_archivo'];
$nombre_descarga = $libro['nombre'] . '.pdf'; 

if (!file_exists($archivo_a_descargar)) {
    die("Error: El archivo no se encontró en la carpeta del servidor. Por favor, contacte a soporte.");
}

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream'); 
header('Content-Disposition: attachment; filename="' . $nombre_descarga . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($archivo_a_descargar));

readfile($archivo_a_descargar);

exit;
?>