<?php

namespace Rr\Bundle\Centrifugo\Grpc;

use GRPC\Centrifugo\CentrifugoProxyInterface;
use GRPC\Centrifugo\ConnectRequest;
use GRPC\Centrifugo\ConnectResponse;
use GRPC\Centrifugo\NotifyCacheEmptyRequest;
use GRPC\Centrifugo\NotifyCacheEmptyResponse;
use GRPC\Centrifugo\NotifyChannelStateRequest;
use GRPC\Centrifugo\NotifyChannelStateResponse;
use GRPC\Centrifugo\PublishRequest;
use GRPC\Centrifugo\PublishResponse;
use GRPC\Centrifugo\RefreshRequest;
use GRPC\Centrifugo\RefreshResponse;
use GRPC\Centrifugo\RPCRequest;
use GRPC\Centrifugo\RPCResponse;
use GRPC\Centrifugo\StreamSubscribeRequest;
use GRPC\Centrifugo\StreamSubscribeResponse;
use GRPC\Centrifugo\SubRefreshRequest;
use GRPC\Centrifugo\SubRefreshResponse;
use GRPC\Centrifugo\SubscribeRequest;
use GRPC\Centrifugo\SubscribeResponse;
use Spiral\RoadRunner\GRPC\ContextInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class CentrifugoProxy implements CentrifugoProxyInterface
{
    public function __construct(
        protected EventDispatcherInterface $eventDispatcher,
    )
    {
    }

    public function Connect(ContextInterface $ctx, ConnectRequest $in): ConnectResponse
    {
        return new ConnectResponse([
            'allowed'   => true,
            'expire_at' => time() + 3600,
            'info'      => ['role' => 'user'],
        ]);
    }

    public function Refresh(ContextInterface $ctx, RefreshRequest $in): RefreshResponse
    {
        return new RefreshResponse([]);
    }

    public function Subscribe(ContextInterface $ctx, SubscribeRequest $in): SubscribeResponse
    {
        $test = 0;
        return new SubscribeResponse([]);
    }

    public function Publish(ContextInterface $ctx, PublishRequest $in): PublishResponse
    {
        return new PublishResponse([]);
    }

    public function RPC(ContextInterface $ctx, RPCRequest $in): RPCResponse
    {
        return new RPCResponse([
            'data' => $in->getData(),
        ]);
    }

    public function SubRefresh(ContextInterface $ctx, SubRefreshRequest $in): SubRefreshResponse
    {
        return new SubRefreshResponse([
            'allowed'   => true,
        ]);
    }

    public function SubscribeUnidirectional(
        ContextInterface $ctx,
        SubscribeRequest $in
    ): StreamSubscribeResponse {
        return new StreamSubscribeResponse([
            'allowed' => true,
        ]);
    }

    public function SubscribeBidirectional(
        ContextInterface $ctx,
        StreamSubscribeRequest $in
    ): StreamSubscribeResponse {
        return new StreamSubscribeResponse([
            'allowed' => true,
        ]);
    }

    public function NotifyCacheEmpty(
        ContextInterface $ctx,
        NotifyCacheEmptyRequest $in
    ): NotifyCacheEmptyResponse {
        return new NotifyCacheEmptyResponse([]);
    }

    public function NotifyChannelState(
        ContextInterface $ctx,
        NotifyChannelStateRequest $in
    ): NotifyChannelStateResponse {
        return new NotifyChannelStateResponse([]);
    }
}