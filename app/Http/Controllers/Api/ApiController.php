<?php

namespace App\Http\Controllers\Api;

use App\Repositories\OfferRepository;
use App\Services\Resources\OfferResource;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class ApiController extends BaseController
{
    protected $offerRepository;

    public function __construct(OfferRepository $offerRepository)
    {
        $this->offerRepository = $offerRepository;
    }

    public function index(Request $request)
    {
        $request = $request->all();

        return response()->json([
            'data' => $this->offerRepository->findIDs($request)
        ]);
    }

    public function show($offerID)
    {
        $offer = $this->offerRepository->findByOfferID($offerID);

        if(!$offer){
            return response()->json([
                'success' => 'false',
                'message' => 'Offer does not exists'
            ], 404);
        }

        return response()->json([
            'data' => [
                'type' => 'offer',
                'id' => $offerID,
                'attributes' => (new OfferResource($offer))->toResponse()
            ]
        ]);
    }
}
