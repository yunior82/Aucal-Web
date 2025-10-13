
<?php
    require './../vendor/autoload.php';
    $renderer = new \Aucal\Web\Renderer();
    echo $renderer->render('oferta-formativa.twig', []);
    die();