
<?php
require './../vendor/autoload.php';

$conexion = mysqli_connect("localhost", "aucalorg", "AorX07NF14abd") or die ("Error de conexión");
mysqli_select_db($conexion, "aucalorg");
mysqli_query ($conexion, "SET NAMES 'utf8'");

function pagination($page, $max, $distance = 5){
    // Calcula los números que habría por encima
    $above = $max - $page;

    // Si no hay suficientes números por encima
    if ($above < floor($distance / 2)) {
        $currentPosition = $distance - $above;
        // Si no hay suficientes números por debajo
    } else if ($page < ceil(($distance - 1) / 2)) {
        $currentPosition = $page;
    } else {
        $currentPosition = ceil($distance / 2);
    }

    // Comprueba el número por el que tiene que empezar
    $start = $page - ($currentPosition - 1);

    // Si el primer número es negativo, empezamos desde la primera página
    if ($start < 1) {
        $start = 1;
    }

    // Array a devolver
    $pages = array();

    // Añade los números que devolver
    for ($i = 0; $i < $distance; $i++) {
        if (($start + $i) > $max) {
            break;
        }
        $pages[] = ($start + $i);
    }
    return [
        'pages' => $pages,
        'current' => $page,
        'next' => ($page < $max ? ($page + 1) : false),
        'prev' => ($page > 1 ? ($page - 1) : false),
        'max' => $max,
    ];
}

$renderer = new \Aucal\Web\Renderer();
$articles = [];
$featured = [];
$ids = [];
$page = max(1, intval($_GET['page'] ?? 1));

//Conectamos con la tabla de la base de datos
$query = mysqli_query($conexion, 'SELECT COUNT(1) as count FROM mv_articles WHERE status = 1 AND category_id = 1');
$lastPage = ceil($query->fetch_assoc()['count'] / 6);

if($page > $lastPage) {
    $page = $lastPage;
}

// Recupera las noticias
$query = mysqli_query($conexion, 'SELECT id, title, subtitle, meta_description, created_at, image_url, content, slug  FROM mv_articles WHERE status = 1 AND category_id = 1 ORDER BY created_at DESC, id LIMIT ' . (($page - 1) * 6) . ', 6');
while ($item = $query->fetch_assoc()) {
    
    $item['description'] = strip_tags($item['content']);
    
    if (strlen($item['description']) > 220) {
        $item['description'] = mb_substr($item['description'], 0, 220) . '...';
    }
    $item['date'] = strtotime($item['created_at']);
    $articles[] = $item;
    $ids[] = $item['id'];
}

// Recupera tres noticias aleatorias
$query = mysqli_query($conexion, 'SELECT id, title, subtitle, meta_description, created_at, image_url, content, slug FROM mv_articles WHERE status = 1 AND category_id = 1 AND id NOT IN (' . implode(',', $ids) . ') ORDER BY RAND() LIMIT 3');
while ($item = $query->fetch_assoc()) {
    $item['date'] = strtotime($item['created_at']);
    $featured[] = $item;
}

echo $renderer->render('noticias.twig', ['articles' => $articles, 'featured' => $featured, 'pages' => pagination($page, $lastPage, 5)]);
die();