<?php


namespace app;


class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];
    public Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function resolve()
    {

        $currentURL = $_SERVER['REQUEST_URI'] ?? "/";
        if(str_contains($currentURL, '?')) {
            $currentURL = substr($currentURL, 0, strpos($currentURL, '?'));
        }


        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === "GET") {
            // $fn = [ProductController::class, 'index'] for url "/"
            $fn = $this->getRoutes[$currentURL] ?? null;
        } else {
            $fn = $this->postRoutes[$currentURL] ?? null;
        }
        if ($fn) {
            call_user_func($fn, $this);
        } else {
            echo "Page Not Found";
        }
    }

    // $view = product/index
    public function renderView($view, $params= []) {
        foreach ($params as $key=>$value) {
            $$key = $value;
        }
        // store the view in a buffer instead of displaying it on the browser
        ob_start();
        include_once __DIR__ . "/views/$view.php";
        // clean buffer and return the value present in it
        $content = ob_get_clean();
        include_once __DIR__ . "/views/_layout.php";
    }
}