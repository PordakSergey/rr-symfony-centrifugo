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
use Psr\Log\LoggerInterface;
use Rr\Bundle\Centrifugo\Event\Centrifugo\ConnectEvent;
use Rr\Bundle\Centrifugo\Event\Centrifugo\PublishEvent;
use Rr\Bundle\Centrifugo\Event\Centrifugo\SubscribeEvent;
use Spiral\RoadRunner\GRPC\ContextInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class CentrifugoProxy implements CentrifugoProxyInterface
{
    /**
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        protected EventDispatcherInterface $eventDispatcher,
    )
    {
    }

    /**
     * @param ContextInterface $ctx
     * @param ConnectRequest $in
     * @return ConnectResponse
     */
    public function Connect(ContextInterface $ctx, ConnectRequest $in): ConnectResponse
    {
        $event = $this->eventDispatcher->dispatch(new ConnectEvent($in));
        return $event->getResponse() ?? new ConnectResponse([
            'allowed' => true,
            'expire_at' => time() + 3600,
            'info' => ['role' => 'user'],
        ]);
    }

    /**
     * @param ContextInterface $ctx
     * @param RefreshRequest $in
     * @return RefreshResponse
     */
    public function Refresh(ContextInterface $ctx, RefreshRequest $in): RefreshResponse
    {
        return new RefreshResponse([]);
    }

    /**
     * @param ContextInterface $ctx
     * @param SubscribeRequest $in
     * @return SubscribeResponse
     */
    public function Subscribe(ContextInterface $ctx, SubscribeRequest $in): SubscribeResponse
    {
        $event = $this->eventDispatcher->dispatch(new SubscribeEvent($in));
        return $event->getResponse() ?? new SubscribeResponse([]);
    }

    /**
     * @param ContextInterface $ctx
     * @param PublishRequest $in
     * @return PublishResponse
     */
    public function Publish(ContextInterface $ctx, PublishRequest $in): PublishResponse
    {
        $event = $this->eventDispatcher->dispatch(new PublishEvent($in));
        return  $event->getResponse() ?? new PublishResponse([]);
    }

    /**
     * @param ContextInterface $ctx
     * @param RPCRequest $in
     * @return RPCResponse
     */
    public function RPC(ContextInterface $ctx, RPCRequest $in): RPCResponse
    {
        return new RPCResponse([
            'data' => $in->getData(),
        ]);
    }

    /**
     * @param ContextInterface $ctx
     * @param SubRefreshRequest $in
     * @return SubRefreshResponse
     */
    public function SubRefresh(ContextInterface $ctx, SubRefreshRequest $in): SubRefreshResponse
    {
        return new SubRefreshResponse([
            'allowed' => true,
        ]);
    }

    /**
     * @param ContextInterface $ctx
     * @param SubscribeRequest $in
     * @return StreamSubscribeResponse
     */
    public function SubscribeUnidirectional(
        ContextInterface $ctx,
        SubscribeRequest $in
    ): StreamSubscribeResponse
    {
        return new StreamSubscribeResponse([
            'allowed' => true,
        ]);
    }

    /**
     * @param ContextInterface $ctx
     * @param StreamSubscribeRequest $in
     * @return StreamSubscribeResponse
     */
    public function SubscribeBidirectional(
        ContextInterface       $ctx,
        StreamSubscribeRequest $in
    ): StreamSubscribeResponse
    {
        return new StreamSubscribeResponse([
            'allowed' => true,
        ]);
    }

    /**
     * @param ContextInterface $ctx
     * @param NotifyCacheEmptyRequest $in
     * @return NotifyCacheEmptyResponse
     */
    public function NotifyCacheEmpty(
        ContextInterface        $ctx,
        NotifyCacheEmptyRequest $in
    ): NotifyCacheEmptyResponse
    {
        return new NotifyCacheEmptyResponse([]);
    }

    /**
     * @param ContextInterface $ctx
     * @param NotifyChannelStateRequest $in
     * @return NotifyChannelStateResponse
     */
    public function NotifyChannelState(
        ContextInterface          $ctx,
        NotifyChannelStateRequest $in
    ): NotifyChannelStateResponse
    {
        return new NotifyChannelStateResponse([]);
    }
}