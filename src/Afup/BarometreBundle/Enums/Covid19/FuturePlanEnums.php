<?php

declare(strict_types=1);

namespace Afup\BarometreBundle\Enums\Covid19;

use Afup\BarometreBundle\Enums\AbstractEnums;

class FuturePlanEnums extends AbstractEnums
{
    const YES_DELAYED_MY_PROJECT = 1;
    const YES_ACCELERATED_MY_PROJECT = 2;
    const NO_DIDNT_PLAN_TO_CHANGE = 3;
    const NO_I_PLANNED_TO_CHANGE_THIS_YEAR = 4;

    protected $choices = [
        self::YES_DELAYED_MY_PROJECT => "Oui, j'ai retardé mon projet",
        self::YES_ACCELERATED_MY_PROJECT => "Oui, j'ai accéléré mon projet",
        self::NO_DIDNT_PLAN_TO_CHANGE => "Non et je n'avais pas prévu de changer",
        self::NO_I_PLANNED_TO_CHANGE_THIS_YEAR => "Non et j'avais prévu de changer cette année",
    ];
}
