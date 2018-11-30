<?php

namespace App\Http\Controllers\Web;

use App\Exceptions\OutsideAPIException;
use Laravel\Lumen\Routing\Controller as BaseController;
use OutsideAPI;

class WebController extends BaseController
{
    public function getOffers(string $apiServer)
    {
        try{
            $offers = OutsideAPI::getOffers($apiServer);
        } catch (OutsideAPIException $exception){
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ])->setStatusCode(404);
        }

        return response()->json([
            'success' => true,
            'offersCount' => count($offers)
        ]);
    }
}
