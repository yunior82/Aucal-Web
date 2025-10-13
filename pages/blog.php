
<?php
    require './../vendor/autoload.php';

    $conexion = mysqli_connect("localhost", "aucalorg", "AorX07NF14abd") or die ("Error de conexión");
    mysqli_select_db($conexion, "aucalorg");
    mysqli_query ($conexion, "SET NAMES 'utf8'");

    
    $renderer = new \Aucal\Web\Renderer();
    $articles = [];
    $sociales = [];
    $educaciones = [];
    $categories = [];
    $ids = [];
    
    try { 
        // recuperamos categorias id y title
        $query = mysqli_query($conexion, 'SELECT id, title FROM mv_categories');
        while($item = $query->fetch_assoc()) {
            $categories[] = $item;
        }

        // Recupera los posts actualidad
        $query = mysqli_query($conexion, 'SELECT id, title, subtitle, meta_description, created_at, image_url, content, slug  FROM mv_articles WHERE status = 1 AND category_id = 2 ORDER BY created_at DESC, id LIMIT 1');
        while ($item = $query->fetch_assoc()) {
            $item['description'] = strip_tags($item['content']);
            if(strlen($item['description']) > 220) {
                $item['description'] = mb_substr($item['description'], 0, 220) . '...';
            }
            $item['date'] = strtotime($item['created_at']);
            $articles[] = $item;
            $ids[] = $item['id'];
        }

        // Recupera los posts social
        $query = mysqli_query($conexion, 'SELECT id, title, subtitle, meta_description, created_at, image_url, content, slug  FROM mv_articles WHERE status = 1 AND category_id = 3 ORDER BY created_at DESC, id LIMIT 1');
        while ($item = $query->fetch_assoc()) {
            $item['description'] = strip_tags($item['content']);
            if(strlen($item['description']) > 220) {
                $item['description'] = mb_substr($item['description'], 0, 220) . '...';
            }
            $item['date'] = strtotime($item['created_at']);
            $sociales[] = $item;
            $ids[] = $item['id'];
        }

        // Recupera los posts educacion
        $query = mysqli_query($conexion, 'SELECT id, title, subtitle, meta_description, created_at, image_url, content, slug  FROM mv_articles WHERE status = 1 AND category_id = 4 ORDER BY created_at DESC, id LIMIT 1');
        while ($item = $query->fetch_assoc()) {
            $item['description'] = strip_tags($item['content']);
            if(strlen($item['description']) > 220) {
                $item['description'] = mb_substr($item['description'], 0, 220) . '...';
            }
            $item['date'] = strtotime($item['created_at']);
            $educaciones[] = $item;
            $ids[] = $item['id'];
        }


    } catch (\Exception $e) {
        var_dump($e);
        unset($e);
    }
    
    
    echo $renderer->render('blog.twig', ['articles' => $articles, 'sociales' => $sociales, 'educaciones' => $educaciones, 'categories' => $categories]);
    die();