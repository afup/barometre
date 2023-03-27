<?php

declare(strict_types=1);

namespace App\Enums;

class PHPVersionEnums extends AbstractEnums
{
    public const PHP_4 = 0;
    public const PHP_52 = 1;
    public const PHP_53 = 2;
    public const PHP_54 = 3;
    public const PHP_55 = 4;
    public const PHP_56 = 5;
    public const PHP_70 = 6;
    public const PHP_71 = 7;
    public const PHP_72 = 8;
    public const PHP_73 = 9;
    public const PHP_74 = 10;
    public const PHP_80 = 11;
    public const PHP_81 = 12;

    protected array $choices = [
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

    protected function getDefaultValue(): ?int
    {
        return null;
    }
}
