<?php

declare(strict_types=1);

namespace App\Enums;

class RemoteUsageEnums extends AbstractEnums
{
    public const ALWAYS = 1;
    public const OFTEN = 2;
    public const SOME_TIMES = 3;
    public const NEVER = 4;

    /**
     * @var array
     */
    protected $choices = [
        self::ALWAYS => 'oui, tout le temps',
        self::OFTEN => 'régulièrement',
        self::SOME_TIMES => 'de temps en temps',
        self::NEVER => 'jamais',
    ];

    /**
     * {@inheritdoc}
     */
    protected function getDefaultValue()
    {
        return null;
    }
}
