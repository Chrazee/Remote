<?php

namespace Module\Controllers;

use GuzzleHttp\Exception\ConnectException;
use Illuminate\Support\Facades\Lang;
use Module\Connection\Connection;

class RequestController
{
    public function postRequest($data) {
        $parameters = ['token' => $data['token']];

        if(array_key_exists('parameters', $data)) {
            $parameters[] = $data['parameters'];
        }

        try {
            $url = $data['device']['protocol'] . '://' . $data['device']['address'] . '/' . $data['action'];
            $response = Connection::getClient()->post($url, [
                'http_errors' => false,
                'timeout' => 5,
                'form_params' => $parameters
            ]);

            $statusCode = $response->getStatusCode();
            if ($statusCode === 200) {
                $this->response(['status' => true, 'data' => json_decode($response->getBody()->getContents())]);
            } else {
                $responseContent = json_decode($response->getBody()->getContents(), true);
                if ($responseContent['failed_validation'] == "token") {
                    $this->response(['status' => false, 'message' => $statusCode . ": " . $response->getReasonPhrase(), 'errors' => Lang::get('common.device_user_token_not_match')]);
                }
                $this->response(['status' => false, 'message' => $statusCode . ": " . $response->getReasonPhrase(), 'errors' => $responseContent]);
            }
        }
        catch (ConnectException $e) {
            $this->response(['status' => false, 'message' => Lang::get('common.connection_timed_out')]);
        }
    }

    private function response($response) {
        response()->json($response)->send();
        exit();
    }
}
