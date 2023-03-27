<?php

declare(strict_types=1);

namespace App\Enums;

class OsDeveloppmentEnums extends AbstractEnums
{
    public const LINUX = 1;
    public const WINDOWS = 2;
    public const MACOS = 3;

    protected array $choices = [
        self::LINUX => 'Linux',
        self::WINDOWS => 'Windows',
        self::MACOS => 'MacOS',
    ];

    protected function getDefaultValue(): ?int
    {
        return null;
    }
}
