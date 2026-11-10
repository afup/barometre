<?php

declare(strict_types=1);

namespace App\Enums;

class AiJobMarketImpactEnums extends AbstractEnums
{
    public const FORTE_CREATION_D_EMPLOIS = 1;
    public const CREATION_D_EMPLOIS_SPECIALISES = 2;
    public const TRANSFORMATION_DES_COMPETENCES_DEMANDEES = 3;
    public const RALENTISSEMENT_DES_EMBAUCHES = 4;
    public const SUPPRESSION_NETTE_D_EMPLOIS = 5;
    public const NE_SE_PRONONCE_PAS = 6;

    protected array $choices = [
        self::AUTRE => 'Autre',
        self::FORTE_CREATION_D_EMPLOIS => 'Forte création d\'emplois',
        self::CREATION_D_EMPLOIS_SPECIALISES => 'Création d\'emplois spécialisés',
        self::TRANSFORMATION_DES_COMPETENCES_DEMANDEES => 'Transformation des compétences demandées',
        self::RALENTISSEMENT_DES_EMBAUCHES => 'Ralentissement des embauches',
        self::SUPPRESSION_NETTE_D_EMPLOIS => 'Suppression nette d\'emplois',
        self::NE_SE_PRONONCE_PAS => 'Ne se prononce pas',
    ];
}
