<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class LazyMiddlewareDecorator implements MiddlewareInterface
{
    private MiddlewareResolver $resolver;
    private ContainerInterface $container;
    private string $service;

    /**
     * @param \App\Middleware\MiddlewareResolver $resolver
     * @param \Psr\Container\ContainerInterface $container
     * @param string $service
     */
    public function __construct(MiddlewareResolver $resolver, ContainerInterface $container, string $service)
    {
        $this->resolver = $resolver;
        $this->container = $container;
        $this->service = $service;
    }

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Server\RequestHandlerInterface $handler
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $middleware = $this->resolver->resolve($this->container->get($this->service));
        return $middleware->process($request, $handler);
    }
}
