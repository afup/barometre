<?php

declare(strict_types=1);

namespace App\Report;

use App\Trait\ExperienceComputer;

class VariableSalaryReport extends AbstractReport
{
    use ExperienceComputer;

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.experience')
            ->addSelect('response.experienceInYear')
            ->addSelect('response.grossAnnualSalary')
            ->addSelect('response.variableAnnualSalary');

        $data = $this->queryBuilder->fetchAllAssociative();

        $reportData = [];

        foreach ($data as $response) {
            $experience = $this->computeExperience($response);

            if (!isset($reportData[$experience])) {
                $reportData[$experience] = [];
            }
            $reportData[$experience][] = [
                'grossAnnualSalary' => $response['grossAnnualSalary'],
                'variableAnnualSalary' => $response['variableAnnualSalary'],
            ];
        }

        foreach ($reportData as $experience => $salaries) {
            if (\count($salaries) <= $this->minResult) {
                continue;
            }

            $this->data[] = [
                'experience' => $experience,
                'grossAnnualSalary' => array_sum(array_column($salaries, 'grossAnnualSalary')) / \count($salaries),
                'variableAnnualSalary' => array_sum(array_column($salaries, 'variableAnnualSalary')) / \count($salaries),
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
        return 'variable_salary';
    }

    /**
     * report weight.
     *
     * @return int
     */
    public function getWeight(): int
    {
        return -20;
    }
}
