<?php

namespace Afup\BarometreBundle\Enums;

class MeetupParticipationEnums extends AbstractEnums
{
    const ONE_PER_MONTH   = 1;
    const ONE_PER_QUARTER = 2;
    const NEVER           = 3;

    /**
     * @var array
     */
    protected $choices = [
        self::ONE_PER_MONTH   => 'un par mois',
        self::ONE_PER_QUARTER => 'un par trimestre',
        self::NEVER           => 'jamais',
    ];

    /**
     * {@inheritdoc}
     */
    protected function getDefaultValue()
    {
        return null;
    }
}
