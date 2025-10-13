
<?php
    require './../vendor/autoload.php';
    $renderer = new \Aucal\Web\Renderer();
    if (isset ($_GET['errorcode']) && $_GET['errorcode'] == 3) {
        $error = "Ha introducido datos erróneos! Por favor, revise.";
    } else {
        $error = "";
    }
    echo $renderer->render('campus.twig', ['error' => $error]);
    die();