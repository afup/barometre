<?php

declare(strict_types=1);

namespace App\Enums;

class PHPStrengthEnums extends AbstractEnums
{
    public const ECOSYSTEME = 0;
    public const NOMBRE_UTILISATEUR = 1;
    public const QUALITE_DEVELOPPEUR = 2;
    public const PERFORMANCE = 3;
    public const FACILITE_UTILISATION = 4;

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
}
