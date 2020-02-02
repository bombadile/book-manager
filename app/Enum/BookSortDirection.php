<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

final class BookSortDirection extends Enum
{
    public const ASC = "ASC";
    public const DESC = "DESC";
}
