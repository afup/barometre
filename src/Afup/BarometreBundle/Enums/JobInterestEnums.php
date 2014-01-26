<?php

namespace Afup\BarometreBundle\Enums;

class JobInterestEnums extends AbstractEnums
{
    const QUALITE_DE_VIE    = 1;
    const INTERET_TECHNIQUE = 2;
    const AMBIANCE          = 3;
    const REMUNERATION      = 4;

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
