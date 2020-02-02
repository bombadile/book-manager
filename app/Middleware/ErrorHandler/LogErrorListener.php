<?php

declare(strict_types=1);

namespace App\Middleware\ErrorHandler;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;

class LogErrorListener
{
    private LoggerInterface $logger;

    /**
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param \Throwable $e
     * @param \Psr\Http\Message\ServerRequestInterface $request
     */
    public function __invoke(\Throwable $e, ServerRequestInterface $request): void
    {
        $this->logger->error($e->getMessage(), [
            'exception' => $e,
            'request' => self::extractRequest($request),
        ]);
    }

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return array
     */
    private static function extractRequest(ServerRequestInterface $request): array
    {
        return [
            'method' => $request->getMethod(),
            'url' => (string)$request->getUri(),
            'server' => $request->getServerParams(),
            'cookies' => $request->getCookieParams(),
            'body' => $request->getParsedBody(),
        ];
    }
}
