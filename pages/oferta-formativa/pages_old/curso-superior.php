
<?php
require './../../vendor/autoload.php';
require_once './../../../includes/sistema.inc.php';
$renderer = new \Aucal\Web\Renderer();

$slug = @trim(array_pop(explode('/', $_SERVER['REQUEST_URI'])));
$slug = explode('?', $slug)[0];

if(!file_exists(__DIR__ . '/../../views/oferta-formativa/curso-superior/' . $slug . '.twig')) {
    http_response_code(404);
    echo $renderer->render('pagina-no-encontrada.twig');
    die();
}

echo $renderer->render('oferta-formativa/curso-superior/' . $slug . '.twig');
die();