
<?php
    require './../vendor/autoload.php';
    $renderer = new \Aucal\Web\Renderer();
    echo $renderer->render('solicitud-ok.twig');
    die();