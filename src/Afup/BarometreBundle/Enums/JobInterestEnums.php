<?php

namespace Afup\BarometreBundle\Enums;

class JobInterestEnums extends AbstractEnums
{
    const QUALITE_DE_VIE    = 0;
    const INTERET_TECHNIQUE = 1;
    const AMBIANCE          = 2;
    const REMUNERATION      = 3;
    const AUTRE             = 4;

    /**
     * @var array
     */
    protected $choices = array(
        self::QUALITE_DE_VIE    => "La qualité de vie autour de votre emploi",
        self::INTERET_TECHNIQUE => "L'intérêt technique de vos projets",
        self::AMBIANCE          => "L'ambiance dans l'entreprise",
        self::REMUNERATION      => "La rémunération",
        self::AUTRE             => "Autre",
    );
}
