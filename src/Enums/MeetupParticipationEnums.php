<?php

declare(strict_types=1);

namespace App\Enums;

class MeetupParticipationEnums extends AbstractEnums
{
    public const ONE_PER_MONTH = 1;
    public const ONE_PER_QUARTER = 2;
    public const NEVER = 3;

    /**
     * @var array
     */
    protected $choices = [
        self::ONE_PER_MONTH => 'un par mois',
        self::ONE_PER_QUARTER => 'un par trimestre',
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
