<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\Enums;

class FrenchPHPDocumentationQualityEnums extends AbstractEnums
{
    public const TRES_BONNE = 1;
    public const BONNE = 2;
    public const ACCEPTABLE = 3;
    public const MAUVAISE = 4;
    public const TRES_MAUVAISE = 5;

    protected $choices = [
        self::TRES_BONNE => 'Très bonne',
        self::BONNE => 'Bonne',
        self::ACCEPTABLE => 'Acceptable',
        self::MAUVAISE => 'Mauvaise',
        self::TRES_MAUVAISE => 'Très mauvaise',
        self::AUTRE => 'N/A',
    ];
}
