<?php

namespace Afup\BarometreBundle\Enums;

class OsDeveloppmentEnums extends AbstractEnums
{
    const LINUX = 0;
    const WINDOWS = 1;
    const MACOS = 2;

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
