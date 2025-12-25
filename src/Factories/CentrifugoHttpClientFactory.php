<?php

namespace Rr\Bundle\Centrifugo\Factories;

use Rr\Bundle\Centrifugo\Exception\InvalidCentrifugoConfiguration;
use Rr\Bundle\Centrifugo\Http\CentrifugoHttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CentrifugoHttpClientFactory
{
    /**
     * @param HttpClientInterface $httpClient
     * @return CentrifugoHttpClient
     */
    public function fromEnvironment(HttpClientInterface $httpClient): CentrifugoHttpClient
    {
        $centrifugoUrl = $_ENV['CENTRIFUGO'] ?? null;
        $centrifugoSecret = $_ENV['CENTRIFUGO_SECRET'] ?? null;

        if (null === $centrifugoUrl) {
            throw new InvalidCentrifugoConfiguration("Set 'CENTRIFUGO' environment variable");
        }
        if (null === $centrifugoSecret) {
            throw new InvalidCentrifugoConfiguration("Set 'CENTRIFUGO_SECRET' environment variable");
        }

        return new CentrifugoHttpClient($centrifugoUrl, $centrifugoSecret, $httpClient);
    }
}