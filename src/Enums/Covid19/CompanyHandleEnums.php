<?php

declare(strict_types=1);

namespace App\Enums\Covid19;

use App\Enums\AbstractEnums;

class CompanyHandleEnums extends AbstractEnums
{
    const GOOD = 1;
    const VERY_GOOD = 2;
    const NEUTRAL = 3;
    const BAD = 4;
    const VERY_BAD = 5;

    protected $choices = [
        self::GOOD => 'Bien',
        self::VERY_GOOD => 'Très bien',
        self::NEUTRAL => 'Neutre',
        self::BAD => 'Mal',
        self::VERY_BAD => 'Très mal',
    ];
}
