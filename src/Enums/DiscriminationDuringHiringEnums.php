<?php

namespace App\Enums;

class DiscriminationDuringHiringEnums extends AbstractEnums
{
    public const PAS_DU_TOUT_D_ACCORD = 1;
    public const PLUTOT_PAS_D_ACCORD = 2;
    public const SANS_OPINION = 3;
    public const PLUTOT_D_ACCORD = 4;
    public const COMPLETEMENT_D_ACCORD = 5;

    protected array $choices = [
        self::PAS_DU_TOUT_D_ACCORD => 'Pas du tout d\'accord',
        self::PLUTOT_PAS_D_ACCORD => 'Plutôt pas d\'accord',
        self::SANS_OPINION => 'Sans opinion',
        self::PLUTOT_D_ACCORD => 'Plutôt d\'accord',
        self::COMPLETEMENT_D_ACCORD => 'Complètement d\'accord',
    ];
}
