<?php

namespace Afup\BarometreBundle\Enums;

class InitialTrainingEnums extends AbstractEnums
{
    const AUTODIDACTE = 0;
    const BTS_DUT     = 1;
    const LICENCE     = 2;
    const MASTER      = 3;
    const MAITRISE    = 4;
    const AUTRE       = 5;

    /**
     * @var array
     */
    protected $choices = array(
        self::AUTODIDACTE => 'Autodidacte',
        self::BTS_DUT     => 'BTS - DUT - DEUST ou équivalent',
        self::LICENCE     => 'Licence ou équivalent',
        self::MASTER      => 'Niveau Master2  ou ingénieur',
        self::MAITRISE    => 'Maitrise ou équivalent',
        self::AUTRE       => 'Autre',
    );
}
