<?php

namespace Rr\Bundle\Centrifugo\Factories;

use Rr\Bundle\Centrifugo\Contracts\Services\CentrifugoApiServiceInterface;
use Rr\Bundle\Centrifugo\Http\CentrifugoHttpClient;
use Rr\Bundle\Centrifugo\Services\CentrifugoApiService;

class CentrifugoApiServiceFactory
{
    /**
     * @param CentrifugoHttpClient $httpClient
     * @return CentrifugoApiServiceInterface
     */
    public function fromEnvironment(CentrifugoHttpClient $httpClient) : CentrifugoApiServiceInterface
    {
        return new CentrifugoApiService($httpClient);
    }
}