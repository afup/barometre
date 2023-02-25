<?php

declare(strict_types=1);

namespace App\Enums;

class OsDeveloppmentEnums extends AbstractEnums
{
    public const LINUX = 1;
    public const WINDOWS = 2;
    public const MACOS = 3;

    /**
     * @var array
     */
    protected $choices = [
        self::LINUX => 'Linux',
        self::WINDOWS => 'Windows',
        self::MACOS => 'MacOS',
    ];

    /**
     * {@inheritdoc}
     */
    protected function getDefaultValue()
    {
        return null;
    }
}
