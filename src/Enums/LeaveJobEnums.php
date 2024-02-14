<?php

namespace App\Enums;

class LeaveJobEnums extends AbstractEnums
{
    public const REUSSI = 1;
    public const REMIS_A_L_ANNEE_PROCHAINE = 2;
    public const ABANDONNE = 3;
    public const J_AI_PERDU_MON_PRECEDENT_POSTE = 4;

    protected array $choices = [
        self::AUTRE => 'Je n\'ai pas cherché à changer de poste',
        self::REUSSI => 'Réussi',
        self::REMIS_A_L_ANNEE_PROCHAINE => 'Remis à l\'année prochaine',
        self::ABANDONNE => 'Abandonné',
        self::J_AI_PERDU_MON_PRECEDENT_POSTE => 'J\'ai perdu mon précédent poste',
    ];
}
