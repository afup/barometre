<?php

declare(strict_types=1);

namespace App\Enums\Covid19;

use App\Enums\AbstractEnums;

class CompanyTrustEnums extends AbstractEnums
{
    const LIKE_BEFORE = 1;
    const LESSER = 2;
    const BETTER = 3;

    protected $choices = [
        self::LIKE_BEFORE => 'Comme avant',
        self::LESSER => 'Moins bon',
        self::BETTER => 'Meilleur',
    ];
}
