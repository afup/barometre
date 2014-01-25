<?php

namespace Afup\BarometreBundle\Enums;

class PHPVersionEnums extends AbstractEnums
{
    const PHP_53 = 0;
    const PHP_54 = 1;
    const PHP_55 = 2;

    /**
     * @var array
     */
    protected $choices = array(
        // TODO : ajouter les versions précédentes.
        self::PHP_53 => 'PHP 5.3',
        self::PHP_54 => 'PHP 5.4',
        self::PHP_55 => 'PHP 5.5',
    );
}
