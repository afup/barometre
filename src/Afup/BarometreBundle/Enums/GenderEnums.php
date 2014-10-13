<?php

namespace Afup\BarometreBundle\Enums;

class GenderEnums extends AbstractEnums
{
    const MALE = 1;
    const FEMALE = 2;

    /**
     * @var array
     */
    protected $choices = array(
        self::MALE => 'Homme',
        self::FEMALE => 'Femme',
    );
}
