<?php

namespace Afup\BarometreBundle\Enums;

class CompanyTypeEnums extends AbstractEnums
{
    const PRESSE_MEDIA = 1;
    const SSII         = 2;
    const AGENCE_COMM  = 3;
    const CLIENT_FINAL = 4;
    const STARTUP      = 5;
    const EDITEUR      = 6;
    const AGENCE_WEB   = 7;

    /**
     * @var array
     */
    protected $choices = array(
        self::PRESSE_MEDIA => "Presse / média",
        self::SSII         => "SSII / conseil",
        self::AGENCE_COMM  => "Agence de communication",
        self::CLIENT_FINAL => "Service informatique d'un client final",
        self::STARTUP      => "Startup",
        self::EDITEUR      => "Editeur",
        self::AGENCE_WEB   => "Agence Web",
        self::AUTRE        => "Autre",
    );

    /**
     * {@inheritdoc}
     */
    protected function getDefaultValue()
    {
        return null;
    }
}
