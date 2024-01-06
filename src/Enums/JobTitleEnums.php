<?php

declare(strict_types=1);

namespace App\Enums;

class JobTitleEnums extends AbstractEnums
{
    public const DIRECTEUR = 1;
    public const RESPONSABLE_EQUIPE = 2;
    public const CHEF_PROJET = 3;
    public const LEAD_DEVELOPPEUR = 4;
    public const ARCHITECTE = 5;
    public const CONSULTANT = 6;
    public const FORMATEUR = 7;
    public const DEVELOPPEUR = 8;
    public const SYSADMIN = 9;
    public const DEVOPS = 10;

    protected array $choices = [
        self::DIRECTEUR => 'Directeur et Directrice, cadre dirigeant',
        self::RESPONSABLE_EQUIPE => "Cadre intermédiaire, responsable d'équipe",
        self::CHEF_PROJET => 'Chef/Cheffe de projet',
        self::LEAD_DEVELOPPEUR => 'Lead développeur/Lead développeuse',
        self::ARCHITECTE => 'Architecte',
        self::CONSULTANT => 'Consultant',
        self::FORMATEUR => 'Formateur/Formatrice',
        self::DEVELOPPEUR => 'Développeur/Développeuse',
        self::SYSADMIN => 'Sysadmin',
        self::DEVOPS => 'Devops',
        self::AUTRE => 'Autre',
    ];

    public array $oldChoices = [
        self::DIRECTEUR => 'Directeur, cadre dirigeant',
        self::RESPONSABLE_EQUIPE => "Cadre intermédiaire, responsable d'équipe",
        self::CHEF_PROJET => 'Chef de projet',
        self::LEAD_DEVELOPPEUR => 'Lead développeur',
        self::ARCHITECTE => 'Architecte',
        self::CONSULTANT => 'Consultant',
        self::FORMATEUR => 'Formateur',
        self::DEVELOPPEUR => 'Développeur',
        self::SYSADMIN => 'Sysadmin',
        self::DEVOPS => 'Devops',
        self::AUTRE => 'Autre',
    ];
}
