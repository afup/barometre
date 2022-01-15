<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\Enums;

class RetrainingEnums
{
    const YES_SHORT = 1;
    const YES_LONG = 2;
    const NO = 3;
    const YES_WITHOUT_TRAINING = 4;

    /**
     * @var array
     */
    protected $choices = [
        self::YES_SHORT => 'Oui via une formation courte (<= 6 mois)',
        self::YES_LONG => 'Oui via une formation longue (> 6 mois)',
        self::NO => 'Non',
        self::YES_WITHOUT_TRAINING => 'oui, sans formation',
    ];

    /**
     * {@inheritdoc}
     */
    protected function getDefaultValue()
    {
        return null;
    }
}
