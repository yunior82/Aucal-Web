
<?php
require './../vendor/autoload.php';
$renderer = new \Aucal\Web\Renderer();

$slug = @trim(array_pop(explode('/', $_SERVER['REQUEST_URI'])));
$slug = explode('?', $slug)[0];

/*
https://www.aucal.edu/landing-page/sense/diploma-superior-universitario-de-detective-Privado.html
https://www.aucal.edu/landing-page/sense/master-universitario-en-project-management.html
https://www.aucal.edu/landing-page/sense/master-universitario-en-international-business-management.html

https://www.aucal.edu/landing-page/diploma-superior-universitario-de-detective-privado
https://www.aucal.edu/landing-page/master-universitario-en-project-management
https://www.aucal.edu/landing-page/master-universitario-en-international-business-management
*/
if ($slug == "diploma-superior-universitario-de-detective-privado") {
    $slug = "curso-detective-privado";
} elseif($slug == "master-universitario-en-project-management") {
    $slug = "master-executive-en-project-management";
} elseif($slug == "master-universitario-en-international-business-management") {
    $slug = "master-executive-en-international-business-management";
}
// Recupera las noticias
$query = mysqli_query($renderer->db(), 'SELECT * FROM mv_courses WHERE slug = "' . mysqli_real_escape_string($renderer->db(), $slug) . '"');
$course = $query->fetch_assoc();

if(!$course) {
    http_response_code(404);
    echo $renderer->render('pagina-no-encontrada.twig');
    die();
}

echo $renderer->render('landing-page.twig', ['course' => $course]);
die();