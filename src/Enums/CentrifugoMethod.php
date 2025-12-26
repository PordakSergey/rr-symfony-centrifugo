<?php

namespace Rr\Bundle\Centrifugo\Enums;

enum CentrifugoMethod : string
{
    case PUBLISH = '/api/publish';
    case REFRESH = '/api/refresh';
    case SUBSCRIBE = '/api/subscribe';
}
