<?php

declare(strict_types=1);

namespace App\Middleware\ErrorHandler;

use Laminas\Stratigility\Utils;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ErrorResponseGenerator implements ErrorResponseGeneratorInterface
{
    private ResponseInterface $response;

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * @param \Throwable $e
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function generate(
        \Throwable $e,
        ServerRequestInterface $request
    ): ResponseInterface {
        $this->response->withStatus(Utils::getStatusCode($e, $this->response));
        return $this->response;
    }
}
