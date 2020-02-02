<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

final class BookSortField extends Enum
{
    public const ID = "id";
    public const RELEASE_DATE = "releaseDate";
    public const TITLE = "title";
}
