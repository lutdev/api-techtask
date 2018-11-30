<?php

namespace App\Services\Builders;

use App\Services\OutsideAPI\Servers\ServerAPIContract;

class ApiConfigBuilder
{
    /** @var ServerAPIContract */
    public $handler;

    /** @var string */
    public $token;

    /** @var array */
    public $data;

    public function __construct(array $config)
    {
        $this->handler = $config['handler'];

        $this->token = $config['token'];

        $this->data = $config['data'];
    }
}