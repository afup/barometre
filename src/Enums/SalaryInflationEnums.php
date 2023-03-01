<?php

declare(strict_types=1);

namespace App\Enums;

class SalaryInflationEnums extends AbstractEnums
{
    public const YES = 1;
    public const NO = 2;
    public const NC = 3;

    protected array $choices = [
        self::YES => 'Oui',
        self::NO => 'Non',
        self::NC => 'Non concerné',
    ];

    protected function getDefaultValue(): ?int
    {
        return null;
    }
}
