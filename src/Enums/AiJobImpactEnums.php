<?php

declare(strict_types=1);

namespace App\Enums;

class AiJobImpactEnums extends AbstractEnums
{
    public const AUCUN_IMPACT_SIGNIFICATIF = 1;
    public const IMPACT_POSITIF = 2;
    public const TRANSFORMATION_DU_POSTE = 3;
    public const RISQUE_DE_REDUCTION_OU_SUPPRESSION = 4;
    public const INCERTITUDE = 5;

    protected array $choices = [
        self::AUTRE => 'Autre',
        self::AUCUN_IMPACT_SIGNIFICATIF => 'Aucun impact significatif',
        self::IMPACT_POSITIF => 'Impact positif (gain d\'efficacité, montée en compétence…)',
        self::TRANSFORMATION_DU_POSTE => 'Transformation du poste (évolution des missions)',
        self::RISQUE_DE_REDUCTION_OU_SUPPRESSION => 'Risque de réduction ou suppression du poste',
        self::INCERTITUDE => 'Incertitude / difficile à évaluer',
    ];
}
