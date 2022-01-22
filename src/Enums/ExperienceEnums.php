<?php

declare(strict_types=1);

namespace App\Enums;

class ExperienceEnums extends AbstractEnums
{
    const XP_0_2 = 1;
    const XP_2_5 = 2;
    const XP_5_10 = 3;
    const XP_10 = 4;

    /**
     * @var array
     */
    protected $choices = [
        self::XP_0_2 => '0 à 2 ans',
        self::XP_2_5 => '2 à 5 ans',
        self::XP_5_10 => '5 à 10 ans',
        self::XP_10 => 'Plus de 10 ans',
    ];
}
