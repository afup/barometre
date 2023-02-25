<?php

declare(strict_types=1);

namespace App\Enums\Covid19;

use App\Enums\AbstractEnums;

class RegularRemoteFeelingEnums extends AbstractEnums
{
    public const HAPPY_AND_ALREADY_DOING_REMOTE = 1;
    public const NEW_BUT_PREFER_OFFICE = 2;
    public const NEW_LIKE_IT = 3;
    public const DONT_DO_REMOTE = 4;

    protected $choices = [
        self::HAPPY_AND_ALREADY_DOING_REMOTE => "J'en faisais déjà, je suis satisfait",
        self::NEW_BUT_PREFER_OFFICE => "C'est nouveau, je préfère être au bureau",
        self::NEW_LIKE_IT => "C'est nouveau, j'apprécie",
        self::DONT_DO_REMOTE => "Je n'en fais pas",
    ];
}
