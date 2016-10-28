<?php

namespace Afup\BarometreBundle\Enums;

class OtherLanguageEnums extends AbstractEnums
{
    const AUCUN      = 0;
    const JAVASCRIPT = 1;
    const DOT_NET    = 2;
    const JAVA       = 3;
    const RUBY       = 4;
    const PYTHON     = 5;
    const C          = 6;
    const AUTRE      = 7;

    /**
     * @var array
     */
    protected $choices = [
        self::AUCUN      => 'Aucun',
        self::JAVASCRIPT => 'Javascript',
        self::DOT_NET    => '.Net',
        self::JAVA       => 'Java',
        self::RUBY       => 'Ruby',
        self::PYTHON     => 'Python',
        self::C          => 'C / C++',
        self::AUTRE      => 'Autre',
    ];

    /**
     * {@inheritdoc}
     */
    protected function getDefaultValue()
    {
        return self::AUCUN;
    }
}
