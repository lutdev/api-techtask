<?php

namespace App\Services\OutsideAPI\Servers;

class PliriAPI extends ServerAPI implements ServerAPIContract
{
    public function __construct()
    {
        $this->config = config('api-servers.pliri');
    }

    public function offersList(): array
    {
        $endpoint = $this->offersListConfig()['url'];
        $token = $this->config['token'];

        $this->sendGETRequest($endpoint, [
            'access-token' => $token
        ]);

        if($this->responseCode !== 200 || !$this->requestResult->success){
            $this->handleError($this->requestResult->response->message);
        }

        dd($this->requestResult);
    }
}