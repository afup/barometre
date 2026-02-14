<?php

declare(strict_types=1);

namespace App\Report;

use App\Trait\ExperienceComputer;

abstract class AbstractSalaryExperienceWithColumnReport extends AbstractReport
{
    use ExperienceComputer;

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $column = $this->getColumn();
        $this->queryBuilder
            ->select('response.experience')
            ->addSelect('response.experienceInYear')
            ->addSelect('response.annualSalary')
            ->addSelect('response.'.$column)
        ;

        $data = [
            'columns' => [],
            'data' => [],
        ];

        $results = $this->queryBuilder->fetchAllAssociative();

        $reportData = [];

        foreach ($results as $response) {
            $experience = $this->computeExperience($response);

            if (!isset($reportData[$experience])) {
                $reportData[$experience] = [];
            }

            if (!isset($reportData[$experience][$response[$column]])) {
                $reportData[$experience][$response[$column]] = [];
            }

            $reportData[$experience][$response[$column]][] = $response['annualSalary'];
        }

        foreach ($reportData as $experience => $salariesPerColumn) {
            if (!\array_key_exists($experience, $data['data'])) {
                $data['data'][$experience] = [];
            }

            foreach ($salariesPerColumn as $column => $salaries) {
                if (\count($salaries) <= $this->minResult) {
                    continue;
                }

                if (!\in_array($column, $data['columns'], true)) {
                    $data['columns'][] = $column;
                }

                $data['data'][$experience][$column] = [
                    'experience' => $experience,
                    $column => $column,
                    'annualSalary' => array_sum($salaries) / \count($salaries),
                    'nbResponse' => \count($salaries),
                ];
            }
        }

        ksort($data['data']);

        $this->data = $data;
    }

    /**
     * {@inheritdoc}
     */
    public function hasResults(): bool
    {
        $data = $this->getData();

        return \count($data['data']) > 0;
    }

    abstract protected function getColumn(): string;
}
