<?php

namespace Module;

use Exception;

class Includer
{
    protected $controller;
    protected $object;

    public function __construct($fromDirectory)
    {

        $this->controller = base_path('module/Storage/' . $fromDirectory. '/Controller/Controller.php');
        $allowedNamespace = "namespace Module\Storage\{$fromDirectory}\Controller;";



    }

    public function callController () {

    }

    public function callAction($action, $device, $parameters)
    {
        return call_user_func_array([$this, $action], [$device, $parameters]);
    }

    public function __call($method, $parameters)
    {
        throw new Exception('Érvénytelen Kontroller.');
    }
}
