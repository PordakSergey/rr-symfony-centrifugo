<?php

namespace Rr\Bundle\Centrifugo\Services;

use Rr\Bundle\Centrifugo\Contracts\Services\CentrifugoApiServiceInterface;
use Rr\Bundle\Centrifugo\Enums\CentrifugoEndpoint;
use Rr\Bundle\Centrifugo\Http\CentrifugoHttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class CentrifugoApiService implements CentrifugoApiServiceInterface
{
    public function __construct(
        protected CentrifugoHttpClient $centrifugo,
    )
    {
    }

    /**
     * @param array $data
     * @return void
     * @throws TransportExceptionInterface
     */
    public function publish(array $data) : void
    {
        $this->centrifugo->sendRequest(CentrifugoEndpoint::PUBLISH->value, $data);
    }
}