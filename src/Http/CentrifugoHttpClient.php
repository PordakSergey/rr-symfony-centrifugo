<?php

namespace Rr\Bundle\Centrifugo\Http;


use Rr\Bundle\Centrifugo\Contracts\Http\CentrifugoHttpClientInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class CentrifugoHttpClient implements CentrifugoHttpClientInterface
{
    /**
     * @param string $url
     * @param string $secretToken
     * @param HttpClientInterface $httpClient
     */
    public function __construct(
        protected string              $url,
        protected string              $secretToken,
        protected HttpClientInterface $httpClient,
    )
    {
    }

    /**
     * @param string $method
     * @param string $requestBody
     * @return ResponseInterface
     * @throws TransportExceptionInterface
     */
    public function sendRequest(string $method, string $requestBody): ResponseInterface
    {
        return $this->httpClient->request('POST', $this->url . $method, [
            'headers' => [
                'X-API-Key' => $this->secretToken,
                'Content-Type' => 'application/json',
            ],
            'body' => $requestBody,
        ]);
    }
}