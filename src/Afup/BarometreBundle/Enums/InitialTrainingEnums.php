<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\Enums;

class InitialTrainingEnums extends AbstractEnums
{
    public const AUTODIDACTE = 1;
    public const BAC = 2;
    public const BTS_DUT = 3;
    public const LICENCE = 4;
    public const MASTER = 5;

    /**
     * @var array
     */
    protected $choices = [
        self::AUTODIDACTE => 'Autodidacte',
        self::BAC => 'Bac',
        self::BTS_DUT => 'BTS - DUT - DEUST ou équivalent',
        self::LICENCE => 'Licence ou équivalent',
        self::MASTER => 'Niveau Master2 ou ingénieur',
        self::AUTRE => 'Autre',
    ];

    /**
     * {@inheritdoc}
     */
    protected function getDefaultValue()
    {
        return null;
    }
}
