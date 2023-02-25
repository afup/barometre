<?php

declare(strict_types=1);

namespace App\Enums\Covid19;

use App\Enums\AbstractEnums;

class CompanyHandleEnums extends AbstractEnums
{
    public const GOOD = 1;
    public const VERY_GOOD = 2;
    public const NEUTRAL = 3;
    public const BAD = 4;
    public const VERY_BAD = 5;

    protected $choices = [
        self::GOOD => 'Bien',
        self::VERY_GOOD => 'Très bien',
        self::NEUTRAL => 'Neutre',
        self::BAD => 'Mal',
        self::VERY_BAD => 'Très mal',
    ];
}
