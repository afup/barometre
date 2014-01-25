<?php

namespace Afup\BarometreBundle\Enums;

class StatusEnums extends AbstractEnums
{
    const CDD         = 0;
    const CDI         = 1;
    const FREELANCE   = 2;
    const SANS_EMPLOI = 3;

    /**
     * @var array
     */
    protected $choices = array(
        self::CDD         => 'Contrat à durée déterminée',
        self::CDI         => 'Contrat à durée indéterminée',
        self::FREELANCE   => 'Freelance / entreprise individuelle',
        self::SANS_EMPLOI => 'Sans emploi',
    );
}
