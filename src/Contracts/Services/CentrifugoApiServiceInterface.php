<?php

namespace Rr\Bundle\Centrifugo\Contracts\Services;

use Rr\Bundle\Centrifugo\Contracts\Requests\CentrifugoRequestInterface;

interface CentrifugoApiServiceInterface
{
    /**
     * @param CentrifugoRequestInterface $request
     * @return void
     */
    public function publish(CentrifugoRequestInterface $request): void;
}