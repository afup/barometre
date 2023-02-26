<?php

declare(strict_types=1);

namespace App\Enums;

class ExperienceEnums extends AbstractEnums
{
    public const XP_0_2 = 1;
    public const XP_2_5 = 2;
    public const XP_5_10 = 3;
    public const XP_10 = 4;

    protected array $choices = [
        self::XP_0_2 => '0 à 2 ans',
        self::XP_2_5 => '2 à 5 ans',
        self::XP_5_10 => '5 à 10 ans',
        self::XP_10 => 'Plus de 10 ans',
    ];
}
