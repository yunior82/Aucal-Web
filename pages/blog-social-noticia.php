<?php
require './../vendor/autoload.php';

$conexion = mysqli_connect("localhost", "aucalorg", "AorX07NF14abd") or die ("Error de conexión");
mysqli_select_db($conexion, "aucalorg");
mysqli_query ($conexion, "SET NAMES 'utf8'");

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

echo $renderer->render('blog-social-noticia.twig',  ['article' => $article, 'articles' => $articles]);
die();