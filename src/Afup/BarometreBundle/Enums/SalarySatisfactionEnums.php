<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\Enums;

class SalarySatisfactionEnums extends AbstractEnums
{
    public const TRES_INSATISFAIT = 1;
    public const INSATISFAIT = 2;
    public const SANS_OPINION = 3;
    public const STATISFAIT = 4;
    public const TRES_SATISFAIT = 5;

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
