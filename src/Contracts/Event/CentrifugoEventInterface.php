<?php

namespace Rr\Bundle\Centrifugo\Contracts\Event;

use Google\Protobuf\Internal\Message;

interface CentrifugoEventInterface
{
    public function getRequest(): Message;
    public function getResponse(): ?Message;
    public function setResponse(?Message $response): self;
}