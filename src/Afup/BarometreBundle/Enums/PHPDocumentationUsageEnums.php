<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\Enums;

class PHPDocumentationUsageEnums extends AbstractEnums
{
    public const IN_FRENCH = 1;
    public const IN_ENGLISH = 2;
    public const FIRST_FRENCH_THEN_ENGLISH = 3;

    protected $choices = [
        self::IN_FRENCH => 'La documentation de php.net en français',
        self::IN_ENGLISH => 'La documentation de php.net en anglais',
        self::FIRST_FRENCH_THEN_ENGLISH => 'La documentation de php.net en français puis en anglais si elle est incomplète/incompréhensible',
        self::AUTRE => 'Autre (documentation intégrée dans IDE par exemple)',
    ];
}
