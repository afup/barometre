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
        'Directeur, cadre dirigeant' => self::DIRECTEUR,
        "Cadre intermédiaire, responsable d'équipe" => self::RESPONSABLE_EQUIPE,
        'Chef de projet' => self::CHEF_PROJET,
        'Lead développeur' => self::LEAD_DEVELOPPEUR,
        'Architecte' => self::ARCHITECTE,
        'Consultant' => self::CONSULTANT,
        'Formateur' => self::FORMATEUR,
        'Développeur' => self::DEVELOPPEUR,
        'Sysadmin' => self::SYSADMIN,
        'Devops' => self::DEVOPS,
        'Autre' => self::AUTRE,
    ];
}
