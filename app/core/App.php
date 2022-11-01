<?php
class App
{
    protected $controller = "HomeController";
    protected $method = "index";
    protected $params = [];

    public function __construct()
    {
        $url = $this->filterUrl();

        // get controller name
        if (isset($url[0])) {
            $controller = ucfirst(strtolower($url[0])) . "Controller";
            // cek file controller exist or not
            if (file_exists("../app/controllers/" . $controller . ".php")) {
                $this->controller = $controller;
                unset($url[0]);
            }
        }

        // create instance controller
        require_once "../app/controllers/$this->controller.php";
        $this->controller = new $this->controller;

        // get method name
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // get parameter
        if (!empty($url)) {
            $this->params = $url;
        }

        // menjalankan method
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function filterUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            return $url;
        }
    }
}
