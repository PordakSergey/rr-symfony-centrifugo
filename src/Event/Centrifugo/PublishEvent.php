<?php

namespace Rr\Bundle\Centrifugo\Event\Centrifugo;

use Google\Protobuf\Internal\Message;
use GRPC\Centrifugo\PublishRequest;
use GRPC\Centrifugo\PublishResponse;
use Rr\Bundle\Centrifugo\Contracts\Event\CentrifugoEventInterface;
use Symfony\Contracts\EventDispatcher\Event;

class PublishEvent  extends Event implements CentrifugoEventInterface
{
    /**
     * @var PublishResponse
     */
    private ?PublishResponse $response = null;

    public function __construct(
        private PublishRequest $request,
    ){
    }

    /**
     * @return Message
     */
    public function getRequest(): Message
    {
        return $this->request;
    }

    /**
     * @return Message|null
     */
    public function getResponse(): ?Message
    {
        return $this->response;
    }

    /**
     * @param PublishResponse|Message|null $response
     * @return $this
     */
    public function setResponse(PublishResponse|Message|null $response): self
    {
        $this->response = $response;
        return $this;
    }
}