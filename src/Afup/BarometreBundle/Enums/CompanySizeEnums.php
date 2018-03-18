<?php

namespace Afup\BarometreBundle\Enums;

class CompanySizeEnums extends AbstractEnums
{
    const FREELANCE = 0;
    const DE_2_A_9 = 1;
    const DE_10_A_49 = 2;
    const DE_50_A_199 = 3;
    const DE_200_A_499 = 4;
    const DE_500_A_999 = 5;
    const PLUS_DE_1000 = 6;

    /**
     * @var array
     */
    protected $choices = [
        self::FREELANCE => 'Freelance ou entreprise individuelle',
        self::DE_2_A_9 => 'De 2 à 9 salariés',
        self::DE_10_A_49 => 'De 10 à 49 salariés',
        self::DE_50_A_199 => 'De 50 à 199 salariés',
        self::DE_200_A_499 => 'De 200 à 499 salariés',
        self::DE_500_A_999 => 'De 500 à 999 salariés',
        self::PLUS_DE_1000 => 'Plus de 1000 salariés',
    ];

    /**
     * {@inheritdoc}
     */
    protected function getDefaultValue()
    {
        return null;
    }
}
