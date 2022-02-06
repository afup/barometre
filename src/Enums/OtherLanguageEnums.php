<?php

declare(strict_types=1);

namespace App\Enums;

class OtherLanguageEnums extends AbstractEnums
{
    const JAVASCRIPT = 1;
    const DOT_NET = 2;
    const JAVA = 3;
    const RUBY = 4;
    const PYTHON = 5;
    const C = 6;
    const AUTRE = 7;
    const GO = 8;
    const RUST = 9;

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
