<?php

namespace App\Services\OutsideAPI\Servers;

class AffiseAPI extends ServerAPI  implements ServerAPIContract
{
    public function __construct()
    {
        $this->config = config('api-servers.affise');
    }

    public function offersList(): array
    {
        $endpoint = $this->offersListConfig()['url'];
        $token = $this->config['token'];

        $this->sendGETRequest($endpoint, [
            'api-key' => $token
        ]);

        if($this->responseCode !== 200){
            $this->handleError($this->requestResult->error);
        }

        dd($this->requestResult);
    }
}