<?php


namespace ModuleApp\Connection;

use GuzzleHttp\Client;

class Connection
{
    protected static $client = null;

    public static function getClient() {
        if(self::$client == null) {
            self::$client = new Client([
                'header' => [
                    'User-Agent' => 'Remote',
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ],
                'verify' => false
            ]);
        }
        return self::$client;
    }
}
