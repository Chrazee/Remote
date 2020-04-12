<?php

use Module\Controllers\RequestController;

class ModuleController extends RequestController
{
    function get($device, $parameters) {
        $this->response(['api_error' => ['header' => 'ez a thermometercontroller get function']]);
    }
}
