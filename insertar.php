<?php
require_once('conexion.php');

// 2. Array de productos (libros)
$productos = [ 
    [
        "imagen" => "img/sangre_fria.jpg",
        "nombre" => "Sangre fria",
        "descripcion" => "A sangre fría de Truman Capote es una novela de no ficción que narra el brutal asesinato de la familia Clutter en Holcomb, Kansas, en 1959, a manos de Perry Smith y Dick Hickock. Capote investigó el crimen a fondo, entrevistando a todos los implicados, incluidos los asesinos, y detalló la vida en el pueblo, la investigación policial y el juicio, explorando el contexto social y los motivos del crimen.",
        "autor" => "Truman Capote",
        "categoria" => "Novela",
    ],
    [
        "imagen" => "img/frankenstein.jpg",
        "nombre" => "Frankenstein",
        "descripcion" => "En la novela Frankenstein de Mary Shelley, el científico Víctor Frankenstein crea una criatura a partir de partes de cadáveres, pero la abandona al horrorizarse de su aspecto. Rechazado y solo, el monstruo, que solo desea compañía y comprensión, comienza a matar a los seres queridos de su creador como venganza.",
        "autor" => "Mary Shelley",
        "categoria" => "Terror",
    ],
    [
        "imagen" => "img/dracula.jpg",
        "nombre" => "Dracula",
        "descripcion" => "Drácula de Bram Stoker narra el viaje del abogado Jonathan Harker al castillo del Conde Drácula en Transilvania para cerrar una transacción inmobiliaria. Harker descubre que Drácula es un vampiro que planea expandir su maldad a Inglaterra. Tras el escape de Harker, Drácula se traslada a Londres, donde ataca a Lucy Westenra, una amiga de la prometida de Harker, Mina.","autor" => "Bram Stoker",
        "categoria" => "Terror",
    ],
    [
        "imagen" => "img/watchmen.jpg",
        "nombre" => "Watchmen",
        "descripcion" => "Watchmen es una novela gráfica que, ambientada en una realidad alternativa de 1985, narra la investigación del asesinato del Comediante por el vigilante Rorschach, lo que saca de su retiro a otros enmascarados como Búho Nocturno, Ozymandias, Dr. Manhattan y Espectro de Seda.", "autor" => "Alan Moore",
        "categoria" => "Acción",
    ],
    [
        "imagen" => "img/1984.jpg",
        "nombre" => "1984",
        "descripcion" => "1984 de George Orwell es una novela distópica que se sitúa en un Londres bajo el control de un régimen totalitario representado por el Gran Hermano. El protagonista, Winston Smith, trabaja reescribiendo la historia en el Ministerio de la Verdad, pero decide rebelarse contra el sistema y se embarca en una relación prohibida con Julia. Su rebelión es descubierta por la Policía del Pensamiento y termina en tortura y adoctrinamiento en el Ministerio del Amor, donde sus ideas son completamente destruidas.",
        "autor" => "George Orwell",
        "categoria" => "Ciencia ficcion",
    ],
    [
        "imagen" => "img/principito.jpg",
        "nombre" => "El principito",
        "descripcion" => "El Principito narra el encuentro entre un piloto varado en el desierto del Sahara y un niño de otro planeta que le pide que dibuje un cordero. A través de sus conversaciones, el piloto aprende del Principito sobre su pequeño asteroide, los viajes a otros planetas con adultos egocéntricos (un rey, un vanidoso, un bebedor, un hombre de negocios, un farolero, un geógrafo) y su relación con una rosa especial. ",
        "autor" => "Antoine de Saint-Exupéry",
        "categoria" => "Fabula",
    ],
    [
        "imagen" => "img/nada.jpg",
        "nombre" => "Nada",
        "descripcion" => "La sinopsis del libro Nada de Carmen Laforet describe la llegada de la joven Andrea a la Barcelona de la posguerra para estudiar Letras, pero sus ilusiones chocan con la sórdida realidad de la casa de su abuela",
        "autor" => "Carmen Lafoert",
        "categoria" => "ficcion",
    ],
    [
        "imagen" => "img/Camino.jpg", 
        "nombre" => "Camino",
        "descripcion" => "El camino, de Miguel Delibes, narra los recuerdos de Daniel, el Mochuelo, un niño de once años la noche antes de partir a estudiar a la ciudad, abandonando su aldea en la España de posguerra. A través de sus recuerdos, se describe la vida rural, las amistades, el primer amor y la dureza de un mundo marcado por la pobreza, concluyendo con la pérdida de la infancia y la transición a la adultez, en un contexto de cambio social y migración campo-ciudad.",
        "autor" => "Miguel Delibes",
        "categoria" => "ficcion",
    ],
    [
        "imagen" => "img/perdida.jpg", 
        "nombre" => "Perdida",
        "descripcion" => "Perdida de Gillian Flynn narra la desaparición de Amy Dunne, la esposa de Nick Dunne, en su quinto aniversario de bodas, lo que convierte a Nick en el principal sospechoso. La historia se alterna entre la perspectiva de Nick, centrándose en la investigación policial y su manipulación de la opinión pública, y los fragmentos del diario de Amy, que revelan la historia de su matrimonio y el lado más oscuro de su relación.",
        "autor" => "Gillian Flynn",
        "categoria" => "Novela",
    ],
    [
        "imagen" => "img/salvaje.jpg", 
        "nombre" => "Salvaje",
        "descripcion" => "Salvaje narra el viaje en solitario de Cheryl Strayed por el Sendero de la Cresta del Pacífico (PCT) tras la muerte de su madre y la disolución de su matrimonio, una aventura de miles de kilómetros sin experiencia previa para superar su dolor y reconstruir su vida.",
        "autor" => "Cheryl Strayed",
        "categoria" => "Aventura",
    ],
    [
        "imagen" => "img/elantris.jpeg", 
        "nombre" => "Elantris",
        "descripcion" => "Elantris de Brandon Sanderson es una novela de fantasía que narra la caída de la ciudad de Elantris, una metrópolis mágica cuyos habitantes fueron transformados en seres decadentes y sin vida debido a una misteriosa maldición. La historia sigue a tres personajes principales: Raoden, el príncipe exiliado de Arelon; Sarene, una princesa política; y Hrathen, un sacerdote fanático, cuyas vidas se entrelazan mientras luchan por salvar Elantris y descubrir la verdad detrás de su caída.",
        "autor" => "Brandon Sanderson",
        "categoria" => "Fantasía",
    ],
    [
        "imagen" => "img/el_ nombre_del_viento.jpeg", 
        "nombre" => "El  nombre del viento",
        "descripcion" => "El  nombre del viento de Patrick Rothfuss narra la historia de Kvothe, un legendario músico, mago y asesino que cuenta su vida desde la infancia en un grupo de artistas itinerantes hasta su paso por la Universidad. El libro explora su búsqueda para descubrir la verdad sobre los Chandrian, seres demoníacos que asesinaron a su familia.",
        "autor" => "Patrick Rothfuss",
        "categoria" => "Fantasía",
    ],
    [
        "imagen" => "img/seda.jpeg", 
        "nombre" => "Seda",
        "descripcion" => "Seda de Alessandro Baricco narra el viaje del comerciante de gusanos de seda Hervé Joncour a Japón a finales del siglo XIX para obtener huevos sanos. Durante sus viajes, desarrolla una obsesión silenciosa por la concubina sin  nombre de un señor local. Es una novela corta, poética y sensual sobre el deseo, la distancia y la pasión no consumada.",
        "autor" => "Alessandro Baricco",
        "categoria" => "Novela",
    ],
    [
        "imagen" => "img/lolita.png", 
        "nombre" => "Lolita",
        "descripcion" => "Lolita de Vladimir Nabokov es narrada por Humbert Humbert, un profesor de mediana edad obsesionado con las 'nínfulas', niñas púberes. Su obsesión se centra en Dolores Haze, a la que llama Lolita, y con la que intenta mantener una relación amorosa y abusiva tras casarse con la madre de la niña.",
        "autor" => "Vladimir Nabokov",
        "categoria" => "Novela",
    ],
    [
        "imagen" => "img/los_pilares_de_la_tierra.jpeg", 
        "nombre" => "Los pilares de la tierra",
        "descripcion" => "Los Pilares de la Tierra de Ken Follett es una novela histórica ambientada en el siglo XII en Inglaterra. La trama se centra en la construcción de una gran catedral gótica en la ciudad ficticia de Kingsbridge, entrelazando las vidas de varios personajes, incluyendo al constructor Tom Builder, el ambicioso obispo Waleran Bigod y la noble Lady Aliena, mientras luchan en un contexto de guerra civil, intrigas religiosas y luchas de poder.",
        "autor" => "Ken Follett",
        "categoria" => "Novela Histórica",
    ],
    [
        "imagen" => "img/la_ilusion_del_tiempo.jpeg", 
        "nombre" => "La ilusion del tiempo",
        "descripcion" => "La Ilusión del Tiempo de José A. López Guerrero es un ensayo que explora el concepto del tiempo desde múltiples perspectivas: física, biológica, cosmológica y filosófica. El autor desglosa cómo la percepción humana del tiempo es fundamentalmente una ilusión creada por nuestra conciencia, la memoria y el funcionamiento del cerebro, contrastándolo con el tiempo como una dimensión real en la física moderna.",
        "autor" => "José A. López Guerrero",
        "categoria" => "Ensayo",
    ],
    [
        "imagen" => "img/cosmos.jpeg", 
        "nombre" => "Cosmos",
        "descripcion" => "Cosmos de Carl Sagan es una obra de divulgación científica que explora la historia de la astronomía, la evolución del universo, la vida y la ciencia. Basado en su serie de televisión, el libro lleva al lector en un viaje a través del espacio y el tiempo, abordando desde los orígenes del cosmos hasta la posibilidad de vida extraterrestre y el futuro de la humanidad, siempre con un enfoque poético y accesible.",
        "autor" => "Carl Sagan",
        "categoria" => "Ciencia",
    ],
    [
        "imagen" => "img/bomarzo.jpeg", 
        "nombre" => "Bomarzo",
        "descripcion" => "Bomarzo de Manuel Mujica Lainez es una novela que narra la vida del duque Pier Francesco Orsini, un noble jorobado del Renacimiento italiano, dueño de los jardines de Bomarzo (el Parque de los Monstruos). La historia es un complejo relato de intrigas, pasiones oscuras, brujería y obsesión por la inmortalidad, narrada en primera persona por el propio duque, revelando su alma torturada.",
        "autor" => "Manuel Mujica Lainez",
        "categoria" => "Novela Histórica",
    ],
    [
        "imagen" => "img/demonios.jpeg", 
        "nombre" => "Demonios",
        "descripcion" => "Los Demonios de Fiódor Dostoievski es una novela política que retrata la inestabilidad social en la Rusia del siglo XIX, inspirada en un hecho real. Sigue a un grupo de jóvenes revolucionarios nihilistas y ateos que buscan destruir el orden social, liderados por Pyotr Verkhovensky y el enigmático Nikolai Stavrogin. La obra es una crítica profunda al radicalismo y las consecuencias morales de la ideología extrema.",
        "autor" => "Fiódor Dostoievski",
        "categoria" => "Novela",
    ],
    [
        "imagen" => "img/soldados_salamina.jpeg", 
        "nombre" => "Soldados de salamina",
        "descripcion" => "Soldados de Salamina de Javier Cercas narra la búsqueda de la escritora y periodista Lola para investigar un episodio de la Guerra Civil Española: el fusilamiento fallido del escritor y falangista Rafael Sánchez Mazas. El foco se pone en el soldado republicano que le perdona la vida. La novela explora la memoria histórica, el heroísmo, la ficción y la realidad.",
        "autor" => "Javier Cercas",
        "categoria" => "Novela Histórica",
    ]
];
$sql = "INSERT INTO productos (imagen, nombre, descripcion, autor, categoria) 
        VALUES (?, ?, ?, ?, ?)";
if ($stmt = $con->prepare($sql)) {
    $stmt->bind_param("sssss", $imagen, $nombre, $descripcion, $autor, $categoria);
    $insertados = 0;
}
    foreach ($productos as $producto) {
        $imagen = $producto['imagen'];
        $nombre = $producto['nombre'];
        $descripcion = $producto['descripcion'];
        $autor = $producto['autor'];
        $categoria = $producto['categoria'];
    }
        if ($stmt->execute()) {
            $insertados++;
        } else {
            echo "❌ Error al insertar el producto '{$nombre}': " . $stmt->error . 
    $stmt->close();
}
?>