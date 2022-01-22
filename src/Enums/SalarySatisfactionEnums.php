<?php

declare(strict_types=1);

namespace App\Enums;

class SalarySatisfactionEnums extends AbstractEnums
{
    const TRES_INSATISFAIT = 1;
    const INSATISFAIT = 2;
    const SANS_OPINION = 3;
    const STATISFAIT = 4;
    const TRES_SATISFAIT = 5;

    /**
     * @var array
     */
    protected $choices = [
        self::TRES_INSATISFAIT => 'Très insatisfait',
        self::INSATISFAIT => 'Insatisfait',
        self::SANS_OPINION => 'Sans opinion',
        self::STATISFAIT => 'Satisfait',
        self::TRES_SATISFAIT => 'Très satisfait',
    ];
}
