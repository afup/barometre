<?php

declare(strict_types=1);

namespace App\Report;

use App\Trait\ExperienceComputer;

class SpecialitySalaryReport extends AbstractReport
{
    use ExperienceComputer;

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->join(
                'response',
                'response_speciality',
                'response_speciality',
                'response.id = response_speciality.response_id'
            )
           ->join(
               'response_speciality',
               'speciality',
               'speciality',
               'response_speciality.speciality_id = speciality.id'
           )
           ->select('response.id')
           ->addSelect('response.experience')
           ->addSelect('response.experienceInYear')
           ->addSelect('speciality.name as specialityName')
           ->addSelect('annualSalary')
        ;

        $results = $this->queryBuilder->fetchAllAssociative();

        // top 5 technos
        $framework = [
            'Symfony',
            'Laravel',
            'Zend Framework',
            'Wordpress',
            'Drupal',
        ];

        $otherFramework = 'report.view.other_framework';

        $data = [
            'columns' => array_merge($framework, [$otherFramework]),
        ];

        $reportData = [];

        foreach ($results as $response) {
            $experience = $this->computeExperience($response);
            $specialityName = $otherFramework;

            if (\in_array($response['specialityName'], $framework, true)) {
                $specialityName = $response['specialityName'];
            }

            if (!isset($reportData[$experience])) {
                $reportData[$experience] = [];
            }

            if (!isset($reportData[$experience][$specialityName])) {
                $reportData[$experience][$specialityName] = [];
            }

            $reportData[$experience][$specialityName][$response['id']] = $response['annualSalary'];
        }

        $data['data'] = array_fill_keys(array_keys($reportData), array_fill_keys($data['columns'], 0));

        foreach ($reportData as $experience => $specialities) {
            foreach ($specialities as $speciality => $salaries) {
                if (\count($salaries) <= $this->minResult) {
                    continue;
                }

                $data['data'][$experience][$speciality] = array_sum($salaries) / \count($salaries);
            }
        }

        ksort($data['data']);

        $this->data = $data;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'speciality_salary';
    }

    /**
     * {@inheritdoc}
     */
    public function hasResults()
    {
        $data = $this->getData();

        return \count($data['data']);
    }

    /**
     * report weight.
     *
     * @return int
     */
    public function getWeight()
    {
        return 6;
    }
}
