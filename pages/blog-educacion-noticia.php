<?php
require './../vendor/autoload.php';

require_once __DIR__ . '/../config/config.php';

$renderer = new \Aucal\Web\Renderer();

$slug = @trim(array_pop(explode('/', $_SERVER['REQUEST_URI'])));
$slug = explode('?', $slug)[0];

// Recupera las noticias
$query = mysqli_query($conexion, 'SELECT * FROM mv_articles WHERE slug = "' . mysqli_real_escape_string($conexion, $slug) . '"');
$article = $query->fetch_assoc();

if(!$article) {
    http_response_code(404);
    echo $renderer->render('pagina-no-encontrada.twig');
    die();
}

$article['date'] = $article['created_at'];

echo $renderer->render('blog-educacion-noticia.twig',  ['article' => $article, 'articles' => $articles]);
die();