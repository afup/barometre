<?php

declare(strict_types=1);

namespace App\Enums;

class WorkMethodEnums extends AbstractEnums
{
    const CYCLE_EN_V = 1;
    const SCRUM = 2;
    const KANBAN = 3;
    const EXTREME_PROGRAMMING = 4;

    protected $choices = [
        self::CYCLE_EN_V => 'Cycle en V',
        self::SCRUM => 'Scrum',
        self::KANBAN => 'Kanban',
        self::EXTREME_PROGRAMMING => 'Extreme programming',
        self::AUTRE => 'Autre',
    ];
}
