<?php

/** @var \App\Application $app */

$app->pipe(App\Middleware\ErrorHandler\ErrorHandlerMiddleware::class);
$app->pipe(App\Middleware\ResponseLoggerMiddleware::class);
$app->pipe(Middlewares\JsonPayload::class);
$app->pipe(PsCs\Middleware\Graphql\WebonyxGraphqlMiddleware::class);
