<?php

declare(strict_types=1);

namespace App\Enums;

class WorkMethodEnums extends AbstractEnums
{
    public const CYCLE_EN_V = 1;
    public const SCRUM = 2;
    public const KANBAN = 3;
    public const EXTREME_PROGRAMMING = 4;

    protected array $choices = [
        self::CYCLE_EN_V => 'Cycle en V',
        self::SCRUM => 'Scrum',
        self::KANBAN => 'Kanban',
        self::EXTREME_PROGRAMMING => 'Extreme programming',
        self::AUTRE => 'Autre',
    ];
}
