
<?php
require './../../vendor/autoload.php';

$renderer = new \Aucal\Web\Renderer();

$courses=[];

$query = mysqli_query($renderer->db(), "SELECT * FROM mv_courses WHERE status = 1 AND category_id = 2");

while ($course = $query->fetch_assoc()) {
    $courses[] = $course;  
}

echo $renderer->render('oferta-formativa/masteres-oficiales.twig', ['courses' => $courses]);
die();