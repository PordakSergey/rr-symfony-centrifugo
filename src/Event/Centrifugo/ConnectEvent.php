<?php

namespace Rr\Bundle\Centrifugo\Event\Centrifugo;

use Google\Protobuf\Internal\Message;
use GRPC\Centrifugo\ConnectRequest;
use GRPC\Centrifugo\ConnectResponse;
use Rr\Bundle\Centrifugo\Contracts\Event\CentrifugoEventInterface;
use Symfony\Contracts\EventDispatcher\Event;

class ConnectEvent extends Event implements CentrifugoEventInterface
{
    /**
     * @var ConnectResponse|null
     */
    private ?ConnectResponse $response = null;

    /**
     * @param ConnectRequest $requset
     */
    public function __construct(
        private ConnectRequest $requset
    )
    {
    }

    /**
     * @param ConnectResponse|Message|null $response
     * @return $this
     */
    public function setResponse(ConnectResponse|Message|null $response): self
    {
        $this->response = $response;
        return $this;
    }

    /**
     * @return ConnectResponse|null
     */
    public function getResponse(): ?ConnectResponse
    {
        return $this->response;
    }

    /**
     * @return ConnectRequest
     */
    public function getRequest(): ConnectRequest
    {
        return $this->requset;
    }
}