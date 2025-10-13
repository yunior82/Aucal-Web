
<?php
require './../../vendor/autoload.php';
$renderer = new \Aucal\Web\Renderer();

// $slug = @trim(array_pop(explode('/', $_SERVER['REQUEST_URI'])));
// $slug = explode('?', $slug)[0];

// Recupera las noticias
$sql_q = 'SELECT * FROM mv_courses WHERE category_id = 2 AND slug = "master-direccion-recursos-humanos"';
// die($sql_q);
$query = mysqli_query($renderer->db(), $sql_q);
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
echo $renderer->render('oferta-formativa/test.twig', ['course' => $course]);
die();