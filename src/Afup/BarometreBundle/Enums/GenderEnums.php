<?php

namespace Afup\BarometreBundle\Enums;

class GenderEnums extends AbstractEnums
{
    const NONE = null;
    const MALE = 1;
    const FEMALE = 2;

    /**
     * @var array
     */
    protected $choices = [
        self::MALE => 'Hommes',
        self::FEMALE => 'Femmes',
        self::NONE => 'Non précisé',
    ];

    /**
     * {@inheritdoc}
     */
    protected function getDefaultValue()
    {
        return self::NONE;
    }
}
