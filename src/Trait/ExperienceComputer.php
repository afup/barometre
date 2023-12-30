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

        if ($response['experienceInYear'] < 15) {
            return ExperienceEnums::XP_10_15;
        }

        if ($response['experienceInYear'] < 20) {
            return ExperienceEnums::XP_15_20;
        }

        if ($response['experienceInYear'] < 25) {
            return ExperienceEnums::XP_20_25;
        }

        if ($response['experienceInYear'] < 30) {
            return ExperienceEnums::XP_25_30;
        }

        if ($response['experienceInYear'] < 35) {
            return ExperienceEnums::XP_30_35;
        }

        if ($response['experienceInYear'] < 40) {
            return ExperienceEnums::XP_35_40;
        }

        return ExperienceEnums::XP_40;
    }
}
