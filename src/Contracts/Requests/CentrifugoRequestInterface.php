<?php

namespace Rr\Bundle\Centrifugo\Contracts\Requests;

interface CentrifugoRequestInterface
{
    public function toArray() : array;
}