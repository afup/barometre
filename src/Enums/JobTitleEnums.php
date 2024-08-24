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

    public const DEV_JUNIOR = 11;
    public const DEV_CONFIRME = 12;
    public const DEV_SENIOR = 13;
    public const DEV_EXPERT = 14;
    public const TECH_LEAD = 15;

    protected array $choices = [
        self::DIRECTEUR => 'Directeur et Directrice, cadre dirigeant',
        self::DEV_JUNIOR => 'Développeuse / Développeur Junior',
        self::DEV_CONFIRME => 'Développeuse / Développeur confirmé',
        self::DEV_SENIOR => 'Développeuse / Développeur Senior',
        self::DEV_EXPERT => 'Développeuse / Développeur Expert',
        self::TECH_LEAD => 'Tech Lead',
        self::RESPONSABLE_EQUIPE => "Responsable d'équipe",
        self::CONSULTANT => 'Consultante / Consultant',
        self::ARCHITECTE => 'Architecte',
        self::CHEF_PROJET => 'Chef/Cheffe de projet',
        self::FORMATEUR => 'Formatrice / Formateur',
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
