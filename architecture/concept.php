<?php

interface UserConfigLoader{
    public function getCFG(String $key);
}

Class UserConfigFILE implements UserConfigLoader{
    public function getCFG(String $key){}
}
Class UserConfigDB implements UserConfigLoader{
    public function getCFG(String $key){}
}
Class UserConfigREDIS implements UserConfigLoader{
    public function getCFG(String $key){}
}
Class UserConfigCLOUD implements UserConfigLoader{
    public function getCFG(String $key){}
}
Class UserConfigECT implements UserConfigLoader{
    public function getCFG(String $key){}
}


class Concept {
    private $client;

    public function __construct() {
        $this->client = new \GuzzleHttp\Client();
    }

    public function getSecretKey():String{
        $driver=USER_CONFIG_DRIVER;
        $UserConfig = new $driver;
        return $UserConfig->getCFG('SecretKey');
    }

    public function getUserData() {
        $params = [
            'auth' => ['user', 'pass'],
            'token' => $this->getSecretKey()
        ];

        $request = new \Request('GET', 'https://api.method', $params);
        $promise = $this->client->sendAsync($request)->then(function ($response) {
            $result = $response->getBody();
        });

        $promise->wait();
    }
}