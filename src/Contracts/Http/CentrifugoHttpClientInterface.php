<?php

namespace Rr\Bundle\Centrifugo\Contracts\Http;

use Symfony\Contracts\HttpClient\ResponseInterface;

interface CentrifugoHttpClientInterface
{
    public function sendRequest(string $method, string $requestBody): ResponseInterface;
}