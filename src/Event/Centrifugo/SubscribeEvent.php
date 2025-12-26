<?php

namespace Rr\Bundle\Centrifugo\Event\Centrifugo;

use Google\Protobuf\Internal\Message;
use GRPC\Centrifugo\SubscribeRequest;
use GRPC\Centrifugo\SubscribeResponse;
use Rr\Bundle\Centrifugo\Contracts\Event\CentrifugoEventInterface;
use Symfony\Contracts\EventDispatcher\Event;

class SubscribeEvent extends Event implements CentrifugoEventInterface
{
    /**
     * @var SubscribeResponse|null
     */
    private ?SubscribeResponse $response = null;

    /**
     * @param SubscribeRequest $request
     */
    public function __construct(
        private SubscribeRequest $request)
    {
    }

    /**
     * @return SubscribeRequest
     */
    public function getRequest(): SubscribeRequest
    {
        return $this->request;
    }

    /**
     * @return SubscribeResponse
     */
    public function getResponse(): SubscribeResponse
    {
        return $this->response;
    }

    /**
     * @param SubscribeResponse|Message|null $response
     * @return $this
     */
    public function setResponse(SubscribeResponse|Message|null $response): self
    {
        $this->response = $response;
        return $this;
    }
}