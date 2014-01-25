<?php

namespace Afup\BarometreBundle\Enums;

class CompanyTypeEnums extends AbstractEnums
{
    const AGENCE_COMM  = 0;
    const EDITEUR      = 1;
    const PRESSE_MEDIA = 2;
    const CLIENT_FINAL = 3;
    const SSII         = 4;
    const STARTUP      = 5;
    const AUTRE        = 6;

    /**
     * @var array
     */
    protected $choices = array(
        self::AGENCE_COMM  => "Agence de communication",
        self::EDITEUR      => "Editeur",
        self::PRESSE_MEDIA => "Presse / média",
        self::CLIENT_FINAL => "Service informatique d'un client final",
        self::SSII         => "SSII / conseil",
        self::STARTUP      => "Startup",
        self::AUTRE        => "Autre",
    );
}
