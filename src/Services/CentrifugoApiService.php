<?php

namespace Rr\Bundle\Centrifugo\Services;

use GRPC\Centrifugo\PublishRequest;
use GRPC\Centrifugo\RefreshRequest;
use GRPC\Centrifugo\SubscribeRequest;
use Rr\Bundle\Centrifugo\Contracts\Services\CentrifugoApiServiceInterface;
use Rr\Bundle\Centrifugo\Enums\CentrifugoMethod;
use Rr\Bundle\Centrifugo\Exception\CentrifugoApiResponseException;
use Rr\Bundle\Centrifugo\Http\CentrifugoHttpClient;
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
     * @param string $chanel
     * @param array $data
     * @param string|null $user
     * @return void
     * @throws CentrifugoApiResponseException
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterfaceAlias
     */
    public function publish(string $chanel, array $data, string|null $user = null): void
    {
        $request = new PublishRequest();
        $request->setChannel($chanel);
        $request->setEncoding('json');
        $request->setProtocol('json');
        $request->setData(json_encode($data));
        if ($user) {
            $request->setUser($user);
        }

        $this->call(CentrifugoMethod::PUBLISH, $request->serializeToJsonString());
    }

    /**
     * @param string $user
     * @param string|null $client
     * @return void
     * @throws CentrifugoApiResponseException
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterfaceAlias
     */
    public function refresh(string  $user,?string $client = null) : void
    {
        $request = new RefreshRequest();
        $request->setUser($user);

        if ($client) {
            $request->setClient($client);
        }

        $request->setEncoding('json');
        $request->setProtocol('json');

        $this->call(CentrifugoMethod::REFRESH, $request->serializeToJsonString());
    }

    /**
     * @param string $channel
     * @param string $user
     * @param array $data
     * @return void
     * @throws TransportExceptionInterfaceAlias
     */
    public function subscribe(
        string $channel,
        string $user,
        array $data = [],
    ) : void
    {
        $request = new SubscribeRequest();
        $request->setChannel($channel);
        $request->setUser($user);
        $request->setData(json_encode($data));
        $request->setEncoding('json');
        $request->setProtocol('json');

        $this->call(CentrifugoMethod::SUBSCRIBE, $request->serializeToJsonString());
    }

    /**
     * @param CentrifugoMethod $method
     * @param string $requestBody
     * @return void
     * @throws CentrifugoApiResponseException
     * @throws TransportExceptionInterfaceAlias
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function call(CentrifugoMethod $method, string $requestBody): void
    {
        $response = $this->centrifugo->sendRequest($method->value, $requestBody);

        if($response->getStatusCode() !== 200){
            throw new CentrifugoApiResponseException($response->getStatusCode(), $response->getContent());
        }
    }
}