
<?php
require './../vendor/autoload.php';

$conexion = mysqli_connect("localhost", "aucalorg", "AorX07NF14abd") or die ("Error de conexión");
mysqli_select_db($conexion, "aucalorg");
mysqli_query ($conexion, "SET NAMES 'utf8'");

$slug = @trim(array_pop(explode('/', $_SERVER['REQUEST_URI'])));
$slug = explode('?', $slug)[0];

$renderer = new \Aucal\Web\Renderer();

// Recupera las noticias
$query = mysqli_query($conexion, 'SELECT * FROM mv_articles WHERE slug = "' . mysqli_real_escape_string($conexion, $slug) . '"');
$article = $query->fetch_assoc();

if(!$article) {
    http_response_code(404);
    echo $renderer->render('pagina-no-encontrada.twig');
    die();
}

$article['date'] = strtotime($article['created_at']);

// Recupera tres noticias aleatorias
$articles = [];
$query = mysqli_query($conexion, 'SELECT * FROM mv_articles WHERE category_id = 1 AND status = 1 AND id NOT IN (' . $article['id'] . ') ORDER BY RAND() LIMIT 3');
while ($item = $query->fetch_assoc()) {
    $item['description'] = strip_tags($item['content']);
    if (strlen($item['description']) > 220) {
        $item['description'] = mb_substr($item['description'], 0, 220) . '...';
    }
    $item['date'] = strtotime($item['created_at']);
    $articles[] = $item;
}


echo $renderer->render('noticia.twig', ['article' => $article, 'articles' => $articles]);
die();