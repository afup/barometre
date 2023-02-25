<?php

declare(strict_types=1);

namespace App\Enums\Covid19;

use App\Enums\AbstractEnums;

class CompanyTrustEnums extends AbstractEnums
{
    public const LIKE_BEFORE = 1;
    public const LESSER = 2;
    public const BETTER = 3;

    protected $choices = [
        self::LIKE_BEFORE => 'Comme avant',
        self::LESSER => 'Moins bon',
        self::BETTER => 'Meilleur',
    ];
}
