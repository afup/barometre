<?php

declare(strict_types=1);

namespace App\Enums;

class AiUsageFrequencyEnums extends AbstractEnums
{
    public const NE_UTILISE_PAS = 1;
    public const AUTOCOMPLETION = 2;
    public const CHAT_PONCTUEL = 3;
    public const PROMPT_MANUEL = 4;
    public const SPECS_PUIS_GENERATION = 5;
    public const USER_STORIES_PUIS_GENERATION = 6;
    public const WORKFLOWS_AGENTS = 7;
    public const BOUCLES_AUTOMATISEES = 8;

    protected array $choices = [
        self::AUTRE => 'Autre',
        self::NE_UTILISE_PAS => 'Je n\'utilise pas d\'IA générative',
        self::AUTOCOMPLETION => 'Surtout comme auto-complétion avancée dans l\'éditeur',
        self::CHAT_PONCTUEL => 'De temps en temps en mode chat (questions, explications, debug…)',
        self::PROMPT_MANUEL => 'J\'écris mes prompts "à la main" et l\'IA génère du code',
        self::SPECS_PUIS_GENERATION => 'L\'IA m\'aide à écrire les specs, puis génère le code',
        self::USER_STORIES_PUIS_GENERATION => 'J\'écris des specs / user stories, puis l\'IA génère le code',
        self::WORKFLOWS_AGENTS => 'J\'utilise des workflows avec agents (itérations specs ↔ code ↔ tests)',
        self::BOUCLES_AUTOMATISEES => 'Ça va jusqu\'à des boucles quasi automatisées (génération, tests, corrections, déploiement)',
    ];
}
