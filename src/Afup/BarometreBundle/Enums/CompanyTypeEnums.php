<?php

namespace Afup\BarometreBundle\Enums;

class CompanyTypeEnums extends AbstractEnums
{
    const PRESSE_MEDIA = 1;
    const SSII = 2;
    const AGENCE_COMM = 3;
    const CLIENT_FINAL = 4;
    const STARTUP = 5;
    const EDITEUR = 6;

    /**
     * @var array
     */
    protected $choices = [
        self::PRESSE_MEDIA => 'Presse / média',
        self::SSII => 'SSII / agence web / conseil',
        self::AGENCE_COMM => 'Agence de communication',
        self::CLIENT_FINAL => "Service informatique d'un client final",
        self::STARTUP => 'Startup',
        self::EDITEUR => 'Editeur',
        self::AUTRE => 'Autre',
    ];

    /**
     * {@inheritdoc}
     */
    protected function getDefaultValue()
    {
        return null;
    }
}
