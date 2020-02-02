<?php

declare(strict_types=1);

namespace App\Middleware\ErrorHandler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Whoops\Handler\JsonResponseHandler;
use Whoops\RunInterface;
use Laminas\Stratigility\Utils;

class WhoopsErrorResponseGenerator implements ErrorResponseGeneratorInterface
{
    private RunInterface $whoops;
    private ResponseInterface $response;

    /**
     * @param \Whoops\RunInterface $whoops
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    public function __construct(RunInterface $whoops, ResponseInterface $response)
    {
        $this->whoops = $whoops;
        $this->response = $response;
    }

    /**
     * @param \Throwable $e
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function generate(\Throwable $e, ServerRequestInterface $request): ResponseInterface
    {
        foreach ($this->whoops->getHandlers() as $handler) {
            if ($handler instanceof JsonResponseHandler) {
                $handler->setJsonApi(true);
                $handler->addTraceToOutput(true);
            }
        }

        $response = $this->response->withStatus(Utils::getStatusCode($e, $this->response));

        $response
            ->getBody()
            ->write($this->whoops->handleException($e));

        return $response;
    }
}
