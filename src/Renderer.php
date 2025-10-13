<?php

namespace Aucal\Web;

class Renderer
{
    public function __construct()
    {
        $this->db = mysqli_connect("localhost", "aucalorg", "AorX07NF14abd") or die("Error de conexión");
        mysqli_select_db($this->db, "aucalorg");
        mysqli_query($this->db, "SET NAMES 'utf8'");

        // Recuperamos los cursos
        $this->courses = [];
        $query = mysqli_query($this->db, "SELECT * FROM mv_courses WHERE status = 1");
        while ($course = $query->fetch_assoc()) {
            $this->courses[] = $course;
        }

        $this->loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../views');
        $this->twig = new \Twig\Environment($this->loader, [
            'cache' => realpath(__DIR__ . '/../storage'),
            'debug' => true,
        ]);

    }

    public function db()
    {
        return $this->db;
    }

    public function render($filename, ...$variables)
    {
        $template = $this->twig->load($filename);
        $globals = ['global' => [
            'courses' => $this->courses,
        ]];
        return $template->render(array_merge($globals, ...$variables));
    }
}
