<?php

declare(strict_types=1);

namespace App\Campaign\Format\Formats;

use App\Campaign\Format\FormatInterface;
use App\Enums\SalarySatisfactionEnums;

class Format2014 implements FormatInterface
{
    /**
     * @return array
     */
    public function getColumns()
    {
        return [
            '',
            'gross_annual_salary',
            'variable_annual_salary',
            'salary_satisfaction',
            'initial_training',
            'status',
            'job_title',
            'experience',
            'company_department',
            'company_type',
            'company_size',
            'job_interest',
            'speciality',
            'php_version',
            'has_certification',
            'certification_list',
            'php_strength',
            'has_formation',
            'formation_subject',
            'formation_impact',
            'email',
            'gender',
        ];
    }

    /**
     * @return array
     */
    public function alterData(array $data)
    {
        $data['annual_salary'] = $data['gross_annual_salary'] + $data['variable_annual_salary'];

        if ('Un homme' === $data['gender'] || 'Homme' === $data['gender']) {
            $data['gender'] = 'Hommes';
        } elseif ('Une femme' === $data['gender'] || 'Femme' === $data['gender']) {
            $data['gender'] = 'Femmes';
        }

        if (0 === $data['salary_satisfaction']) {
            $data['salary_satisfaction'] = SalarySatisfactionEnums::SANS_OPINION;
        }

        $status = explode(',', $data['status']);

        $data['status'] = '' !== $status[0] ? ucfirst($status[0]) : 'Autre';

        if ('Niveau Master2  ou ingénieur' === $data['initial_training']) {
            $data['initial_training'] = 'Niveau Master2 ou ingénieur';
        }

        if ('Maitrise ou équivalent' === $data['initial_training']) {
            $data['initial_training'] = 'Autre';
        }

        return $data;
    }
}
