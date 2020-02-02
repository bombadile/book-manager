<?php


namespace App\Helastel2;

interface ProviderInterface
{
    /**
     * @param array $input
     * @return array|null
     */
    public function getResponse(array $input): ?array;
}