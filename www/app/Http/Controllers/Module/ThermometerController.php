<?php

namespace App\Http\Controllers\Module;

class ThermometerController extends RequestController
{
    function get($device, $parameters) {
        $this->response(['api_error' => ['header' => 'ez a thermometercontroller get function']]);
    }
}
