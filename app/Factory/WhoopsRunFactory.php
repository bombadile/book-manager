<?php

declare(strict_types=1);

namespace App\Factory;

use Whoops\Handler\JsonResponseHandler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class WhoopsRunFactory
{
    /**
     * @return \Whoops\Run
     */
    public function __invoke(): Run
    {
        $whoops = new Run();
        $whoops->writeToOutput(false);
        $whoops->allowQuit(false);
        $whoops->pushHandler(new JsonResponseHandler());
        $whoops->register();
        return $whoops;
    }
}
