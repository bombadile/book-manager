<?php

declare(strict_types=1);

namespace App;

use App\Middleware\ErrorHandler\ResolverNotFoundHandler;
use App\Middleware\MiddlewareResolver;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Stratigility\MiddlewarePipe;

class Application implements RequestHandlerInterface
{
    private MiddlewareResolver $resolver;
    private MiddlewarePipe $pipeline;
    private RequestHandlerInterface $defaultHandler;

    /**
     * @param \App\Middleware\MiddlewareResolver $resolver
     */
    public function __construct(MiddlewareResolver $resolver)
    {
        $this->resolver = $resolver;
        $this->pipeline = new MiddlewarePipe();
        $this->defaultHandler = new ResolverNotFoundHandler();
    }

    /**
     * @param mixed $path
     */
    public function pipe($path): void
    {
        $this->pipeline->pipe($this->resolver->resolve($path));
    }

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->pipeline->process($request, $this->defaultHandler);
    }
}
