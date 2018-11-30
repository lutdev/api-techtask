<?php

namespace App\Facades;

use App\Services\OutsideAPI\OutsideAPI;
use Illuminate\Support\Facades\Facade;

class OutsideAPIFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return OutsideAPI::class;
    }
}