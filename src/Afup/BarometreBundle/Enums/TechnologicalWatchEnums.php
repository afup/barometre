<?php

namespace Afup\BarometreBundle\Enums;

class TechnologicalWatchEnums extends AbstractEnums
{
    const NEVER = 0;
    const LESS_THAN_ONCE_A_WEEK = 1;
    const MULTIPLE_TIME_PER_WEEK = 2;
    const EVERY_DAY = 3;

    /**
     * @var array
     */
    protected $choices = [
        self::NEVER => 'jamais',
        self::LESS_THAN_ONCE_A_WEEK => 'moins d\'une fois par semaine',
        self::MULTIPLE_TIME_PER_WEEK => 'quelques fois par semaine',
        self::EVERY_DAY => 'tous les jours',
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
        return 'technological_watch';
    }
}
