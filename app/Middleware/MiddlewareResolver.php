<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Stratigility\Middleware\RequestHandlerMiddleware;

class MiddlewareResolver
{
    private ContainerInterface $container;
    private ResponseInterface $responsePrototype;

    /**
     * @param \Psr\Container\ContainerInterface $container
     * @param \Psr\Http\Message\ResponseInterface $responsePrototype
     */
    public function __construct(ContainerInterface $container, ResponseInterface $responsePrototype)
    {
        $this->container = $container;
        $this->responsePrototype = $responsePrototype;
    }

    /**
     * @param mixed $handler
     * @return \Psr\Http\Server\MiddlewareInterface
     */
    public function resolve($handler): MiddlewareInterface
    {
        if (\is_string($handler) && $this->container->has($handler)) {
            return new LazyMiddlewareDecorator($this, $this->container, $handler);
        }

        if ($handler instanceof MiddlewareInterface) {
            return $handler;
        }

        if ($handler instanceof RequestHandlerInterface) {
            return new RequestHandlerMiddleware($handler);
        }

        throw new UnknownMiddlewareTypeException($handler);
    }
}
