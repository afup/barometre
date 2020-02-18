<?php

namespace Afup\BarometreBundle\Enums;

class PHPDocumentationUsageEnums extends AbstractEnums
{
    const IN_FRENCH = 1;
    const IN_ENGLISH = 2;
    const FIRST_FRENCH_THEN_ENGLISH = 3;

    protected $choices = [
        self::IN_FRENCH => 'La documentation de php.net en français',
        self::IN_ENGLISH => 'La documentation de php.net en anglais',
        self::FIRST_FRENCH_THEN_ENGLISH => 'La documentation de php.net en français puis en anglais si elle est incomplète/incompréhensible',
        self::AUTRE => 'Autre (documentation intégrée dans IDE par exemple)'
    ];
}
