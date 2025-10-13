<?php

/**
 * Gestiona la subida de imagenes ya procesadas desde el CMS al sitio web en falta de CDN
 */

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: application/json; charset=utf-8');

$folder = $_GET['folder'] ?? 'articles';

$dir = __DIR__ . '/../../uploads/' . $_GET['folder'];

if (!file_exists($dir )) {
    mkdir($dir, 0777, true);
}

if (isset($_FILES['_file'])) {
    $file = $_FILES['_file'];
    if ($file['error'] != UPLOAD_ERR_OK) {
        http_response_code(400);
        die(json_encode(['status' => 400, 'error' => $file['error']]));
    }

    $filename = mb_strtolower(basename($file['name']));
    $filename = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $filename);
    $uploaded = move_uploaded_file($file['tmp_name'], __DIR__ . '/../../uploads/' . $_GET['folder'] . '/' . $filename);

    if ($uploaded) {
        die(json_encode(['status' => 200, 'filename' => 'https://aucal.edu/2022/uploads/' . $_GET['folder'] . '/' . $filename]));
    }
}

http_response_code(400);
die(json_encode(['status' => 400, 'error' => -1]));
