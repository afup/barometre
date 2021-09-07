<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\Enums;

class GenderEnums extends AbstractEnums
{
    public const NONE = null;
    public const MALE = 1;
    public const FEMALE = 2;
    public const NON_BINARY = 3;

    /**
     * @var array
     */
    protected $choices = [
        self::MALE => 'Hommes',
        self::FEMALE => 'Femmes',
        self::NONE => 'Non précisé',
        self::NON_BINARY => 'Personnes non-binaires',
        self::AUTRE => 'Autre',
    ];

    /**
     * {@inheritdoc}
     */
    protected function getDefaultValue()
    {
        return self::NONE;
    }
}
