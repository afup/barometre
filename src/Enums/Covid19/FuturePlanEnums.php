<?php

declare(strict_types=1);

namespace App\Enums\Covid19;

use App\Enums\AbstractEnums;

class FuturePlanEnums extends AbstractEnums
{
    public const YES_DELAYED_MY_PROJECT = 1;
    public const YES_ACCELERATED_MY_PROJECT = 2;
    public const NO_DIDNT_PLAN_TO_CHANGE = 3;
    public const NO_I_PLANNED_TO_CHANGE_THIS_YEAR = 4;

    protected array $choices = [
        self::YES_DELAYED_MY_PROJECT => "Oui, j'ai retardé mon projet",
        self::YES_ACCELERATED_MY_PROJECT => "Oui, j'ai accéléré mon projet",
        self::NO_DIDNT_PLAN_TO_CHANGE => "Non et je n'avais pas prévu de changer",
        self::NO_I_PLANNED_TO_CHANGE_THIS_YEAR => "Non et j'avais prévu de changer cette année",
    ];
}
