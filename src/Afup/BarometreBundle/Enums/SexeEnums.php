<?php

namespace Afup\BarometreBundle\Enums;

class SexeEnums extends AbstractEnums
{
    const HOMME = 1;
    const FEMME = 2;

    /**
     * @var array
     */
    protected $choices = array(
        self::HOMME => 'Homme',
        self::FEMME => 'Femme',
    );
}
