<?php

use App\Middleware\ErrorHandler\ErrorResponseGeneratorInterface;
use App\Application;
use App\Middleware\ErrorHandler\ErrorHandlerMiddleware;
use App\Middleware\MiddlewareResolver;
use GraphQL\Server\StandardServer;
use GraphQL\Type\Schema;
use PsCs\Middleware\Graphql\WebonyxGraphqlMiddleware;
use Psr\SimpleCache\CacheInterface;
use Psr\Log\LoggerInterface;
use App\Service\AuthorService;
use App\Validator\AuthorValidator;
use App\Repository\AuthorRepository;
use App\Service\BookService;
use App\Validator\BookValidator;
use App\Repository\BookRepository;
use App\Factory;

return [
    'dependencies' => [
        'abstract_factories' => [
            Laminas\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory::class,
        ],
        'factories' => [
            Application::class => Factory\ApplicationFactory::class,
            MiddlewareResolver::class => Factory\MiddlewareResolverFactory::class,
            StandardServer::class => Factory\StandardServerFactory::class,
            CacheInterface::class => Factory\CacheInterfaceFactory::class,
            Schema::class => Factory\SchemaFactory::class,
            WebonyxGraphqlMiddleware::class => Factory\WebonyxGraphqlMiddlewareFactory::class,
            ErrorHandlerMiddleware::class => Factory\ErrorHandlerMiddlewareFactory::class,
            ErrorResponseGeneratorInterface::class => Factory\ErrorResponseGeneratorFactory::class,
            LoggerInterface::class => Factory\LoggerFactory::class,
            AuthorService::class => Factory\AuthorServiceFactory::class,
            AuthorValidator::class => Factory\AuthorValidatorFactory::class,
            AuthorRepository::class => Factory\AuthorRepositoryFactory::class,
            BookService::class => Factory\BookServiceFactory::class,
            BookValidator::class => Factory\BookValidatorFactory::class,
            BookRepository::class => Factory\BookRepositoryFactory::class
        ],
    ],

    'debug' => false,
];
