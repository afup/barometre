<?php

declare(strict_types=1);

namespace App\Enums;

class CompanySizeEnums extends AbstractEnums
{
    public const FREELANCE = 0;
    public const DE_2_A_9 = 1;
    public const DE_10_A_49 = 2;
    public const DE_50_A_199 = 3;
    public const DE_200_A_499 = 4;
    public const DE_500_A_999 = 5;
    public const PLUS_DE_1000 = 6;

    protected array $choices = [
        self::FREELANCE => 'Freelance ou entreprise individuelle',
        self::DE_2_A_9 => 'De 2 à 9 salariés',
        self::DE_10_A_49 => 'De 10 à 49 salariés',
        self::DE_50_A_199 => 'De 50 à 199 salariés',
        self::DE_200_A_499 => 'De 200 à 499 salariés',
        self::DE_500_A_999 => 'De 500 à 999 salariés',
        self::PLUS_DE_1000 => 'Plus de 1000 salariés',
    ];

    protected function getDefaultValue(): ?int
    {
        return null;
    }
}
