<?php

namespace Afup\BarometreBundle\Enums;

class InitialTrainingEnums extends AbstractEnums
{
    const AUTODIDACTE = 1;
    const BAC         = 2;
    const BTS_DUT     = 3;
    const LICENCE     = 4;
    const MASTER      = 5;

    /**
     * @var array
     */
    protected $choices = array(
        self::AUTODIDACTE => 'Autodidacte',
        self::BAC         => 'Bac',
        self::BTS_DUT     => 'BTS - DUT - DEUST ou équivalent',
        self::LICENCE     => 'Licence ou équivalent',
        self::MASTER      => 'Niveau Master2  ou ingénieur',
        self::AUTRE       => 'Autre',
    );
}
