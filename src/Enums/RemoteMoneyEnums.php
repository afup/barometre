<?php

declare(strict_types=1);

namespace App\Enums;

class RemoteMoneyEnums extends AbstractEnums
{
    public const YES_FIX = 1;
    public const YES_INVOICE = 2;
    public const YES_PER_DAY = 3;
    public const NO = 4;

    /**
     * @var array
     */
    protected $choices = [
        self::YES_FIX => 'oui, forfait fixe',
        self::YES_INVOICE => 'oui, frais réel',
        self::YES_PER_DAY => 'oui, au prorata du nombre de jour de télétravail',
        self::NO => 'Non',
    ];

    /**
     * {@inheritdoc}
     */
    protected function getDefaultValue()
    {
        return null;
    }
}
