<?php

declare(strict_types=1);

namespace App\Enums\Covid19;

use App\Enums\AbstractEnums;

class LayoffEnums extends AbstractEnums
{
    const YES = 1;
    const NO = 2;

    protected $choices = [
        self::YES => 'Oui',
        self::NO => 'Non',
    ];
}
