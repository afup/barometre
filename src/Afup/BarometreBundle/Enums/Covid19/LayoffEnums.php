<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\Enums\Covid19;

use Afup\BarometreBundle\Enums\AbstractEnums;

class LayoffEnums extends AbstractEnums
{
    const YES = 1;
    const NO = 2;

    protected $choices = [
        self::YES => 'Oui',
        self::NO => 'Non',
    ];
}
