<?php

declare(strict_types=1);

namespace App\Enums\Covid19;

use App\Enums\AbstractEnums;

class SalaryImpactEnums extends AbstractEnums
{
    const YES = 1;
    const NO = 2;
    const DOES_NO_SAY = 3;

    protected $choices = [
        self::YES => 'Oui',
        self::NO => 'Non',
        self::DOES_NO_SAY => 'Ne se prononce pas',
    ];
}
