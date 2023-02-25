<?php

declare(strict_types=1);

namespace App\Enums;

class RetrainingEnums extends AbstractEnums
{
    public const YES_SHORT = 1;
    public const YES_LONG = 2;
    public const NO = 3;
    public const YES_WITHOUT_TRAINING = 4;

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
