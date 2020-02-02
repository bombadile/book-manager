<?php

declare(strict_types=1);

namespace src\Integration;

use App\Helastel2\ProviderInterface;

class DataProvider implements ProviderInterface
{
    private string $host;
    private string $user;
    private string $password;

    /**
     * @param string $host
     * @param string $user
     * @param string $password
     */
    public function __construct(string $host, string $user, string $password)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * @inheritDoc
     */
    public function getResponse(array $input): ?array
    {
        // returns a response from external service
    }
}
