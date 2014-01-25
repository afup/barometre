<?php

namespace Afup\BarometreBundle\Enums;

class PHPStrengthEnums extends AbstractEnums
{
    const ECOSYSTEME           = 0;
    const NOMBRE_UTILISATEUR   = 1;
    const PERFORMANCE          = 2;
    const FACILITE_UTILISATION = 3;
    /**
     * @var array
     */
    protected $choices = array(
        self::ECOSYSTEME           => "Son écosystème (outils, frameworks, documentation)",
        self::NOMBRE_UTILISATEUR   => "Le nombre de développeurs et de sociétés l'utilisant",
        self::PERFORMANCE          => "Sa performance",
        self::FACILITE_UTILISATION => "Sa facilité d'utilisation",
    );
}
