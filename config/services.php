<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Rr\Bundle\Centrifugo\Contracts\Http\CentrifugoHttpClientInterface;
use Rr\Bundle\Centrifugo\Contracts\Services\CentrifugoApiServiceInterface;
use Rr\Bundle\Centrifugo\Factories\CentrifugoApiServiceFactory;
use Rr\Bundle\Centrifugo\Factories\CentrifugoHttpClientFactory;
use Rr\Bundle\Centrifugo\Grpc\CentrifugoProxy;
use Symfony\Contracts\HttpClient\HttpClientInterface;

return static function (ContainerConfigurator $container) {
    $services = $container->services();
    $services->defaults()->autowire()->autoconfigure();

    $services->set(CentrifugoProxy::class);

    $services->set(CentrifugoHttpClientInterface::class)
        ->share(false)
        ->factory([service(CentrifugoHttpClientFactory::class), 'fromEnvironment'])
        ->args([
            service(HttpClientInterface::class),
        ]);

    $services->set(CentrifugoApiServiceInterface::class)
        ->share()
        ->factory([service(CentrifugoApiServiceFactory::class), 'make'])
        ->args([
            service(CentrifugoHttpClientInterface::class),
        ]);
};