<?php

declare(strict_types=1);

namespace App\Enums;

class PHPVersionEnums extends AbstractEnums
{
    const PHP_4 = 0;
    const PHP_52 = 1;
    const PHP_53 = 2;
    const PHP_54 = 3;
    const PHP_55 = 4;
    const PHP_56 = 5;
    const PHP_70 = 6;
    const PHP_71 = 7;
    const PHP_72 = 8;
    const PHP_73 = 9;
    const PHP_74 = 10;
    const PHP_80 = 11;
    const PHP_81 = 12;

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
        self::PHP_70 => 'PHP 7.0',
        self::PHP_71 => 'PHP 7.1',
        self::PHP_72 => 'PHP 7.2',
        self::PHP_73 => 'PHP 7.3',
        self::PHP_74 => 'PHP 7.4',
        self::PHP_80 => 'PHP 8.0',
        self::PHP_81 => 'PHP 8.1',
    ];

    /**
     * {@inheritdoc}
     */
    protected function getDefaultValue()
    {
        return null;
    }
}
