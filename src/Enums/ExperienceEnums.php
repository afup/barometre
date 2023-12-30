<?php

declare(strict_types=1);

namespace App\Enums;

class ExperienceEnums extends AbstractEnums
{
    public const XP_0_2 = 1;
    public const XP_2_5 = 2;
    public const XP_5_10 = 3;
    public const XP_10_15 = 4;
    public const XP_15_20 = 5;
    public const XP_20_25 = 6;
    public const XP_25_30 = 7;
    public const XP_30_35 = 8;
    public const XP_35_40 = 9;
    public const XP_40 = 10;

    protected array $choices = [
        self::XP_0_2 => '0 à 2 ans',
        self::XP_2_5 => '2 à 5 ans',
        self::XP_5_10 => '5 à 10 ans',
        self::XP_10_15 => '10 à 15 ans',
        self::XP_15_20 => '15 à 20 ans',
        self::XP_20_25 => '20 à 25 ans',
        self::XP_25_30 => '25 à 30 ans',
        self::XP_30_35 => '30 à 35 ans',
        self::XP_35_40 => '35 à 40 ans',
        self::XP_40 => 'Plus de 40 ans',
    ];

    protected function getDefaultValue(): ?int
    {
        return null;
    }
}
