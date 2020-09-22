<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\Enums;

class StatusEnums extends AbstractEnums
{
    const CDD = 1;
    const CDI = 2;
    const FREELANCE = 3;
    const SANS_EMPLOI = 4;

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

    public function getAlias(): string
    {
        return 'status';
    }
}
