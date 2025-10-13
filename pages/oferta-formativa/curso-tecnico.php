
<?php
require './../../vendor/autoload.php';
$renderer = new \Aucal\Web\Renderer();

$slug = @trim(array_pop(explode('/', $_SERVER['REQUEST_URI'])));
$slug = explode('?', $slug)[0];

// Recupera las noticias
$query = mysqli_query($renderer->db(), 'SELECT * FROM mv_courses WHERE category_id = 1 AND slug = "' . mysqli_real_escape_string($renderer->db(), $slug) . '"');
$course = $query->fetch_assoc();

if(!$course) {
    http_response_code(404);
    echo $renderer->render('pagina-no-encontrada.twig');
    die();
}

echo $renderer->render('oferta-formativa/curso-tecnico.twig', ['course' => $course]);
die();