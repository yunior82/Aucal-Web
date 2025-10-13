
<?php
require './../../vendor/autoload.php';
require_once './../../../includes/sistema.inc.php';
$renderer = new \Aucal\Web\Renderer();

$courses=[];
$query = mysqli_query($conexion, "SELECT urlcur, nomcur, imgcur, durcur, modcur,h1cur FROM microsites_cursos WHERE pubcur='1' AND unicur='8' ORDER BY nomcur");
while($item = $query->fetch_assoc()) {
    $courses[] = $item;
}

echo $renderer->render('oferta-formativa/masteres-oficiales.twig', ['courses' => $courses]);
die();