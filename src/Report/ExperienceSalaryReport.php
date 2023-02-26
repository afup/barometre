<?php

declare(strict_types=1);

namespace App\Report;

use App\Enums\ExperienceEnums;

class ExperienceSalaryReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.experience')
            ->addSelect('response.experienceInYear')
            ->addSelect('response.annualSalary')
        ;

        $data = $this->queryBuilder->fetchAllAssociative();

        $reportData = [];

        foreach ($data as $response) {
            $experience = $response['experience'] ?? $this->computeExperience($response);

            if (!isset($reportData[$experience])) {
                $reportData[$experience] = [];
            }
            $reportData[$experience][] = $response['annualSalary'];
        }

        foreach ($reportData as $experience => $salaries) {
            if (\count($salaries) <= $this->minResult) {
                continue;
            }

            $this->data[] = [
                'experience' => $experience,
                'annualSalary' => array_sum($salaries) / \count($salaries),
                'nbResponse' => \count($salaries),
            ];
        }

        uasort($this->data, static function (array $experienceA, array $experienceB): int {
            return $experienceA['experience'] <=> $experienceB['experience'];
        });
    }

    /**
     * The report name (used for url).
     *
     * @return string
     */
    public function getName()
    {
        return 'experience_salary';
    }

    /**
     * report weight.
     *
     * @return int
     */
    public function getWeight()
    {
        return 4;
    }

    private function computeExperience(array $response): int
    {
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
