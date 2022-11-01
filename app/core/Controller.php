<?php
class Controller
{
    public function view($view, $data = [])
    {
        $user = null;
        if (isset($_SESSION["auth"])) $user = $_SESSION["auth"];
        require_once("../app/views/" . $view . ".php");
    }

    public function model(string $model)
    {
        require_once("../app/models/" . $model . ".php");
        return new $model;
    }

    public function redirectTo(string $endpoint)
    {
        $endpoint = substr($endpoint, 0, 1) == "/" ? $endpoint : "/" . $endpoint;
        echo "<script> window.location.href = '" . BASE_URL . $endpoint . "'; </script>";
    }
}
