<?php

namespace Afup\BarometreBundle\Enums;

class OsDeveloppmentEnums extends AbstractEnums
{
    const LINUX = 1;
    const WINDOWS = 2;
    const MACOS = 3;

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

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'os_developpment';
    }
}
