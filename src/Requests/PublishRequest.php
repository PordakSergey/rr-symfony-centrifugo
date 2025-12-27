<?php

namespace Rr\Bundle\Centrifugo\Requests;

use Rr\Bundle\Centrifugo\Contracts\Requests\CentrifugoRequestInterface;

readonly class PublishRequest implements CentrifugoRequestInterface
{
    /**
     * @param string $channel
     * @param array $data
     * @param string|null $user
     */
    public function __construct(
        public string  $channel,
        public array   $data,
        public ?string $user,
    )
    {
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        $return = [
            'channel' => $this->channel,
            'data' => $this->data,
        ];
        if(!$this->user){
            $return['user'] = $this->user;
        }

        return $return;
    }
}