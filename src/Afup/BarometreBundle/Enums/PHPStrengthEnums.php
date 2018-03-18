<?php

namespace Afup\BarometreBundle\Enums;

class PHPStrengthEnums extends AbstractEnums
{
    const ECOSYSTEME = 0;
    const NOMBRE_UTILISATEUR = 1;
    const QUALITE_DEVELOPPEUR = 2;
    const PERFORMANCE = 3;
    const FACILITE_UTILISATION = 4;

    /**
     * @var array
     */
    protected $choices = [
        self::ECOSYSTEME => 'Son écosystème (outils, frameworks, documentation)',
        self::NOMBRE_UTILISATEUR => "Le nombre de développeurs et de sociétés l'utilisant",
        self::QUALITE_DEVELOPPEUR => 'La qualité des développeurs sur le marché',
        self::PERFORMANCE => 'Sa performance',
        self::FACILITE_UTILISATION => "Sa facilité d'utilisation",
    ];

    /**
     * {@inheritdoc}
     */
    protected function getDefaultValue()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'php_strength';
    }
}
