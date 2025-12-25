<?php

namespace Rr\Bundle\Centrifugo\Factories;

use Rr\Bundle\Centrifugo\Contracts\Services\CentrifugoApiServiceInterface;
use Rr\Bundle\Centrifugo\Services\CentrifugoApiService;

class CentrifugoApiServiceFactory
{
    public function make() : CentrifugoApiServiceInterface
    {
        return new CentrifugoApiService();
    }
}