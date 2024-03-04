<?php

declare(strict_types=1);

namespace App\Enums;

class CompanyTypeEnums extends AbstractEnums
{
    public const PRESSE_MEDIA = 1;
    public const SSII = 2;
    public const AGENCE_COMM = 3;
    public const CLIENT_FINAL = 4;
    public const STARTUP = 5;
    public const EDITEUR = 6;
    public const AGENCE_WEB = 7;

    protected array $choices = [
        self::PRESSE_MEDIA => 'Presse / média',
        self::SSII => 'Entreprise de services du numérique (ESN) / conseil',
        self::AGENCE_COMM => 'Agence de communication',
        self::CLIENT_FINAL => "Service informatique d'un client final",
        self::STARTUP => 'Startup',
        self::EDITEUR => 'Editeur',
        self::AGENCE_WEB => 'Agence Web',
        self::AUTRE => 'Autre',
    ];

    protected function getDefaultValue(): ?int
    {
        return null;
    }
}
