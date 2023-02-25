<?php

declare(strict_types=1);

namespace App\Enums\Covid19;

use App\Enums\AbstractEnums;

class PartialUnemploymentEnums extends AbstractEnums
{
    public const NO = 1;
    public const YES_BUT_STARTED_BACK = 2;
    public const YES_STILL_IN_PARTIAL_UNEMPLOYMENT = 3;

    protected $choices = [
        self::NO => 'Non',
        self::YES_BUT_STARTED_BACK => "Oui et depuis j'ai repris à temps plein",
        self::YES_STILL_IN_PARTIAL_UNEMPLOYMENT => "Oui encore aujourd'hui",
    ];
}
