<?php

declare(strict_types=1);

namespace App\Enums;

class TechnologicalWatchEnums extends AbstractEnums
{
    public const NEVER = 0;
    public const LESS_THAN_ONCE_A_WEEK = 1;
    public const MULTIPLE_TIME_PER_WEEK = 2;
    public const EVERY_DAY = 3;

    protected array $choices = [
        self::NEVER => 'jamais',
        self::LESS_THAN_ONCE_A_WEEK => 'moins d\'une fois par semaine',
        self::MULTIPLE_TIME_PER_WEEK => 'quelques fois par semaine',
        self::EVERY_DAY => 'tous les jours',
    ];

    protected function getDefaultValue(): ?int
    {
        return null;
    }
}
