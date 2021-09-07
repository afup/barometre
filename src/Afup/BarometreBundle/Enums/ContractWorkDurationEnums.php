<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\Enums;

class ContractWorkDurationEnums extends AbstractEnums
{
    public const HORAIRE_35 = 1;
    public const HORAIRE_37 = 2;
    public const HORAIRE_39 = 3;
    public const FORFAIT_JOUR = 4;

    protected $choices = [
        self::HORAIRE_35 => '35h',
        self::HORAIRE_37 => '37h',
        self::HORAIRE_39 => '39h',
        self::FORFAIT_JOUR => 'Forfait jour',
        self::AUTRE => 'Autre',
    ];
}
