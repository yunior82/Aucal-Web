
<?php
    require __DIR__ . './../vendor/autoload.php';
    require_once __DIR__ . '/../config/config.php';

    $renderer = new \Aucal\Web\Renderer();
    $courses = [];
    $articles = [];

    // Recupera los cursos destacados
    try { 
        $query = mysqli_query($conexion, 'SELECT urlcur, tipocur, nomcur, durcur, modcur, fecinicur, unicur, imgcur FROM microsites_cursos WHERE pubcur = 1 AND destcur = 1 ORDER BY RAND() LIMIT 3');
        while($item = $query->fetch_assoc()) {
            $courses[] = $item;
        }

        // Recupera las noticias
        $query = mysqli_query($conexion, 'SELECT id, title, subtitle, meta_description, created_at, image_url, content, slug FROM mv_articles WHERE status = 1 AND category_id = 1 ORDER BY created_at DESC, id LIMIT 3');
        while ($item = $query->fetch_assoc()) {
            $item['description'] = strip_tags($item['content']);
            if(strlen($item['description']) > 220) {
                $item['description'] = mb_substr($item['description'], 0, 220) . '...';
            }
            $item['date'] = strtotime($item['created_at']);
            $articles[] = $item;
            $ids[] = $item['id'];
        }

        // Recupera el banner
        $query = mysqli_query($conexion, 'SELECT * FROM mv_banner WHERE id = 1 LIMIT 1');
        $banner = $query->fetch_assoc();

    } catch (\Exception $e) {
        var_dump($e);
        unset($e);
    } 
    
    echo $renderer->render('index.twig', ['courses' => $courses, 'articles' => $articles, 'banner' => $banner]);
    die();
