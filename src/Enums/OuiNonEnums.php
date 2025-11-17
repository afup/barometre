<?php

declare(strict_types=1);

namespace App\Enums;

class OuiNonEnums extends AbstractEnums
{
    public const YES = 1;
    public const NO = 0;

    protected array $choices = [
        self::YES => 'Oui',
        self::NO => 'Non',
    ];
}
