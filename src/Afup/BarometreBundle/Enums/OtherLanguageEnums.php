<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\Enums;

class OtherLanguageEnums extends AbstractEnums
{
    public const JAVASCRIPT = 1;
    public const DOT_NET = 2;
    public const JAVA = 3;
    public const RUBY = 4;
    public const PYTHON = 5;
    public const C = 6;
    public const AUTRE = 7;
    public const GO = 8;
    public const RUST = 9;

    /**
     * @var array
     */
    protected $choices = [
        self::JAVASCRIPT => 'Javascript',
        self::DOT_NET => '.Net',
        self::JAVA => 'Java',
        self::RUBY => 'Ruby',
        self::PYTHON => 'Python',
        self::C => 'C / C++',
        self::GO => 'Go',
        self::RUST => 'Rust',
        self::AUTRE => 'Autre',
    ];

    /**
     * {@inheritdoc}
     */
    protected function getDefaultValue()
    {
        return null;
    }
}
