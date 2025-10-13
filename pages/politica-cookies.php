
<?php
    require './../vendor/autoload.php';
    $renderer = new \Aucal\Web\Renderer();
    echo $renderer->render('politica-cookies.twig');
    die();