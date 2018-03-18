<?php

namespace Afup\BarometreBundle\Enums;

class PHPVersionEnums extends AbstractEnums
{
    const PHP_4 = 0;
    const PHP_52 = 1;
    const PHP_53 = 2;
    const PHP_54 = 3;
    const PHP_55 = 4;
    const PHP_56 = 5;
    const PHP_7 = 6;

    /**
     * @var array
     */
    protected $choices = [
        self::PHP_4 => 'PHP 4',
        self::PHP_52 => 'PHP 5.2',
        self::PHP_53 => 'PHP 5.3',
        self::PHP_54 => 'PHP 5.4',
        self::PHP_55 => 'PHP 5.5',
        self::PHP_56 => 'PHP 5.6',
        self::PHP_7 => 'PHP 7',
    ];

    /**
     * {@inheritdoc}
     */
    protected function getDefaultValue()
    {
        return null;
    }
}
