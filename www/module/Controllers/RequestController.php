<?php

namespace Module\Controllers;

use BadMethodCallException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use ModuleApp\Connection\Connection;

class RequestController
{
    protected $parameters;

    protected function get($device, $parameters) {

        //$this->response(['api_error' => ['header' => "Device: " . $device['ip']]]);
        $this->postRequest('get', $device, $parameters);
    }

    protected function postRequest($action, $device, $parameters) {
        try {
            $response = Connection::getClient()->post("http://192.168.0.105/{$action}", [
                'timeout' => 5,
                'form_params' => $parameters
            ]);

            $statusCode = $response->getStatusCode();
            if ($statusCode === 200) {
                $this->response(['status' => true, 'data' => $response->getBody()->getContents()]);
            }
            else if ($statusCode === 404) {
                $this->response(['status' => false, 'message' => "Nincs válasz az eszköz IP címéről."]);
            }
            else {
                $this->response(['status' => false, 'message' => "Az eszköz érvénytelen választ adott"]);
            }
        } catch (ConnectException $e) {
            $this->response(['api_error' => ['header' => 'Nincs kapcsolat az eszközzel']]);
        } catch (ClientException $e) {
            $this->response(['api_error' => ['header' => 'Érvénytelen kommunikáció.']]);
        }
    }

    protected function response($response) {
        response()->json($response)->send();
        exit();
    }

    public function callAction($action, $device, $parameters)
    {
        return call_user_func_array([$this, $action], [$device, $parameters]);
    }

    public function __call($method, $parameters)
    {
        $this->response(['api_error' => ['header' => 'Érvénytelen Kontroller.']]);
    }
}
