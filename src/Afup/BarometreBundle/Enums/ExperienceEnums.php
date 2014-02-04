<?php

namespace Afup\BarometreBundle\Enums;

class ExperienceEnums extends AbstractEnums
{
    const XP_0_2  = 1;
    const XP_3_5  = 2;
    const XP_6_10 = 3;
    const XP_10   = 4;

    /**
     * @var array
     */
    protected $choices = array(
        self::XP_0_2  => '0 à 2 ans',
        self::XP_3_5  => '3 à 5 ans',
        self::XP_6_10 => '6 à 10 ans',
        self::XP_10   => 'Plus de 10 ans'
    );
}
