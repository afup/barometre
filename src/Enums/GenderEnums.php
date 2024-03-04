<?php

declare(strict_types=1);

namespace App\Enums;

class GenderEnums extends AbstractEnums
{
    public const NONE = null;
    public const MALE = 1;
    public const FEMALE = 2;
    public const NON_BINARY = 3;

    protected array $choices = [
        self::MALE => 'Hommes',
        self::FEMALE => 'Femmes',
        self::NONE => 'Non précisé',
        self::NON_BINARY => 'Une personne non-binaire',
        self::AUTRE => 'Autre',
    ];

    protected function getDefaultValue(): ?int
    {
        return self::NONE;
    }
}
