<?php

declare(strict_types=1);

namespace App\Enums;

class AiPerceptionEnums extends AbstractEnums
{
    public const GADGET = 1;
    public const GAIN_DE_CONFORT = 2;
    public const GAIN_DE_PRODUCTIVITE_SIGNIFICATIF = 3;
    public const CHANGEMENT_PROFOND = 4;

    protected array $choices = [
        self::AUTRE => 'Autre',
        self::GADGET => 'Gadget',
        self::GAIN_DE_CONFORT => 'Gain de confort',
        self::GAIN_DE_PRODUCTIVITE_SIGNIFICATIF => 'Gain de productivité significatif',
        self::CHANGEMENT_PROFOND => 'Changement profond de manière de travailler',
    ];
}
