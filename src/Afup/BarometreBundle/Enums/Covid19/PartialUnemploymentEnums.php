<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\Enums\Covid19;

use Afup\BarometreBundle\Enums\AbstractEnums;

class PartialUnemploymentEnums extends AbstractEnums
{
    const NO = 1;
    const YES_BUT_STARTED_BACK = 2;
    const YES_STILL_IN_PARTIAL_UNEMPLOYMENT = 3;

    protected $choices = [
        self::NO => 'Non',
        self::YES_BUT_STARTED_BACK => "Oui et depuis j'ai repris à temps plein",
        self::YES_STILL_IN_PARTIAL_UNEMPLOYMENT => "Oui encore aujourd'hui",
    ];
}
