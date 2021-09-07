<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\Enums;

class StatusEnums extends AbstractEnums
{
    public const CDD = 1;
    public const CDI = 2;
    public const FREELANCE = 3;
    public const SANS_EMPLOI = 4;

    /**
     * @var array
     */
    protected $choices = [
        self::CDD => 'Contrat à durée déterminée',
        self::CDI => 'Contrat à durée indéterminée',
        self::FREELANCE => 'Freelance / entreprise individuelle',
        self::SANS_EMPLOI => 'Sans emploi',
        self::AUTRE => 'Autre',
    ];
}
