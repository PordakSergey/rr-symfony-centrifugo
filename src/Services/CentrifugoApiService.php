<?php

namespace Rr\Bundle\Centrifugo\Services;

use GRPC\Centrifugo\RefreshRequest;
use GRPC\Centrifugo\SubscribeRequest;
use Rr\Bundle\Centrifugo\Contracts\Requests\CentrifugoRequestInterface;
use Rr\Bundle\Centrifugo\Contracts\Services\CentrifugoApiServiceInterface;
use Rr\Bundle\Centrifugo\Enums\CentrifugoMethod;
use Rr\Bundle\Centrifugo\Exception\CentrifugoApiResponseException;
use Rr\Bundle\Centrifugo\Http\CentrifugoHttpClient;
use Rr\Bundle\Centrifugo\Requests\PublishRequest;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface as TransportExceptionInterfaceAlias;

class CentrifugoApiService implements CentrifugoApiServiceInterface
{
    /**
     * @param CentrifugoHttpClient $centrifugo
     */
    public function __construct(
        protected CentrifugoHttpClient $centrifugo,
    )
    {
    }

    /**
     * @param PublishRequest|CentrifugoRequestInterface $request
     * @return void
     * @throws CentrifugoApiResponseException
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterfaceAlias
     */
    public function publish(PublishRequest|CentrifugoRequestInterface $request): void
    {
        $this->call(CentrifugoMethod::PUBLISH, $request->toArray());
    }

    /**
     * @param CentrifugoMethod $method
     * @param array $requestBody
     * @return void
     * @throws CentrifugoApiResponseException
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterfaceAlias
     */
    public function call(CentrifugoMethod $method, array $requestBody): void
    {
        $response = $this->centrifugo->sendRequest($method->value, $requestBody);

        if($response->getStatusCode() !== 200){
            throw new CentrifugoApiResponseException($response->getStatusCode(), $response->getContent());
        }
    }
}