<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\Enums\Covid19;

use Afup\BarometreBundle\Enums\AbstractEnums;

class SalaryImpactEnums extends AbstractEnums
{
    public const YES = 1;
    public const NO = 2;
    public const DOES_NO_SAY = 3;

    protected $choices = [
        self::YES => 'Oui',
        self::NO => 'Non',
        self::DOES_NO_SAY => 'Ne se prononce pas',
    ];
}
