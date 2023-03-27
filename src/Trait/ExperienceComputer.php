<?php

declare(strict_types=1);

namespace App\Trait;

use App\Enums\ExperienceEnums;

trait ExperienceComputer
{
    protected function computeExperience(array $response): int
    {
        if (null !== ($response['experience'] ?? null)) {
            return $response['experience'];
        }

        if ($response['experienceInYear'] < 2) {
            return ExperienceEnums::XP_0_2;
        }

        if ($response['experienceInYear'] < 5) {
            return ExperienceEnums::XP_2_5;
        }

        if ($response['experienceInYear'] < 10) {
            return ExperienceEnums::XP_5_10;
        }

        return ExperienceEnums::XP_10;
    }
}
