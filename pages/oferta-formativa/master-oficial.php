
<?php
require './../../vendor/autoload.php';
$renderer = new \Aucal\Web\Renderer();

$slug = @trim(array_pop(explode('/', $_SERVER['REQUEST_URI'])));
$slug = explode('?', $slug)[0];

// Recupera las noticias
$query = mysqli_query($renderer->db(), 'SELECT * FROM mv_courses WHERE category_id = 2 AND slug = "' . mysqli_real_escape_string($renderer->db(), $slug) . '"');
$course = $query->fetch_assoc();

if(!$course) {
    http_response_code(404);
    echo $renderer->render('pagina-no-encontrada.twig');
    die();
}
// Parche para popup de clientify en determinados programas...
if ($course['id'] == 10 || $course['id'] == 13 || $course['id'] == 16 || $course['id'] == 17) {
    $course['popup_clientify'] = "https://api.clientify.net/web-marketing/webforms/script/112679.js";
} else {
    $course['popup_clientify'] = '';
}
echo $renderer->render('oferta-formativa/master-oficial.twig', ['course' => $course]);
die();