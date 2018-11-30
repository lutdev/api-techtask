<?php

namespace App\Http\Controllers\Api;

use Laravel\Lumen\Routing\Controller as BaseController;

class ApiController extends BaseController
{
    public function index()
    {
        return response()->json([
            'test' => 'index'
        ]);
    }

    public function show()
    {
        return response()->json([
            'test' => 'show'
        ]);
    }
}
