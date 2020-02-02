<?php

declare(strict_types=1);

namespace App\Factory;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Container\ContainerInterface;

class LoggerFactory
{
    /**
     * @param \Psr\Container\ContainerInterface $container
     * @return \Monolog\Logger
     */
    public function __invoke(ContainerInterface $container): Logger
    {
        $log = new Logger('App');
        $log->setTimezone(new \DateTimeZone('Europe/Samara'));
        $log->pushHandler(new StreamHandler(
            'var/log/application.log',
            $container->get('config')['debug'] ? Logger::DEBUG : Logger::WARNING
        ));
        return $log;
    }
}
