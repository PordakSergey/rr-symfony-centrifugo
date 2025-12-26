<?php

namespace Rr\Bundle\Centrifugo\Contracts\Services;

interface CentrifugoApiServiceInterface
{
    public function publish(string $chanel, array $data, string|null $user = null): void;
    public function refresh(string  $user,?string $client = null) : void;
    public function subscribe(
        string $channel,
        string $user,
        array $data = [],
    ) : void;
}