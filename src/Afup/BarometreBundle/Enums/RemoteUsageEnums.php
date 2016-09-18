<?php

namespace Afup\BarometreBundle\Enums;

class RemoteUsageEnums extends AbstractEnums
{
    const ALWAYS      = 1;
    const OFTEN       = 2;
    const SOME_TIMES  = 3;
    const NEVER       = 4;

    /**
     * @var array
     */
    protected $choices = array(
        self::ALWAYS     => "oui, tout le temps",
        self::OFTEN      => "régulièrement",
        self::SOME_TIMES => "de temps en temps",
        self::NEVER      => "jamais",
    );

    /**
     * {@inheritdoc}
     */
    protected function getDefaultValue()
    {
        return null;
    }
}
