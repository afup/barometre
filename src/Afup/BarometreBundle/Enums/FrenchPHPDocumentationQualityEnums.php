<?php

namespace Afup\BarometreBundle\Enums;

class FrenchPHPDocumentationQualityEnums extends AbstractEnums
{
    const TRES_BONNE = 1;
    const BONNE = 2;
    const ACCEPTABLE = 3;
    const MAUVAISE = 4;
    const TRES_MAUVAISE = 5;

    protected $choices = [
        self::TRES_BONNE => 'Très bonne',
        self::BONNE => 'Bonne',
        self::ACCEPTABLE => 'Acceptable',
        self::MAUVAISE => 'Mauvaise',
        self::TRES_MAUVAISE => 'Très mauvaise',
    ];
}
