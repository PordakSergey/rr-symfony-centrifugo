<?php

namespace Rr\Bundle\Centrifugo\Services;

use Rr\Bundle\Centrifugo\Contracts\Services\CentrifugoApiServiceInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CentrifugoApiService implements CentrifugoApiServiceInterface
{
    public function __construct(
        protected HttpClientInterface $httpClient,
    )
    {
    }

    public function publish() : void
    {

    }
}