<?php

declare(strict_types=1);

namespace src\Decorator;

use App\Helastel2\ProviderInterface;
use DateTime;
use Exception;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Cache\InvalidArgumentException;
use Psr\Log\LoggerInterface;

class DataManagerDecorator implements ProviderInterface
{
    public ProviderInterface $provider;
    public CacheItemPoolInterface $cache;
    public LoggerInterface $logger;

    /**
     * @param \App\Helastel2\ProviderInterface $provider
     * @param \Psr\Cache\CacheItemPoolInterface $cache
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        ProviderInterface $provider,
        CacheItemPoolInterface $cache,
        LoggerInterface $logger
    ) {
        $this->provider = $provider;
        $this->cache = $cache;
        $this->logger = $logger;
    }

    /**
     * {@inheritDoc}
     */
    public function getResponse(array $input): ?array
    {
        try {
            $cacheKey = $this->getCacheKey($input);
            $cacheItem = $this->cache->getItem($cacheKey);

            if ($cacheItem->isHit()) {
                return $cacheItem->get();
            }

            $response = $this->provider->getResponse($input);

            $cacheItem
                ->set($response)
                ->expiresAt(
                    (new DateTime())->modify('+1 day')
                );

            return $response;
        } catch (InvalidArgumentException | Exception $e) {
            $this->logger->critical('Error');
        }

        return null;
    }

    /**
     * @param array $input
     * @return null|string
     */
    public function getCacheKey(array $input): ?string
    {
        $key = json_encode($input);
        return $key ?: null;
    }
}
