<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\Enums;

class GenderEnums extends AbstractEnums
{
    const NONE = null;
    const MALE = 1;
    const FEMALE = 2;
    const NON_BINARY = 3;

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
