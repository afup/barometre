<?php

declare(strict_types=1);

namespace App\Campaign\Format\Formats;

use App\Campaign\Format\FormatInterface;

class Format2013 implements FormatInterface
{
    /**
     * @return array
     */
    public function getColumns()
    {
        return [
            'gross_annual_salary',
            'variable_annual_salary',
            'annual_salary',
            'salary_satisfaction',
            'status',
            'initial_training',
            'job_title',
            'experience',
            'company_type',
            'company_size',
            'company_department',
            'job_interest',
            'speciality',
            'php_version',
            'has_certification',
            'certification_list',
            'php_strength',
            'email',
            '',
            '',
            '',
            '',
            'has_formation',
            'formation_subject',
            'formation_impact',
        ];
    }

    /**
     * @return array
     */
    public function alterData(array $data)
    {
        array_walk($data, static function (&$item) {
            $item = utf8_encode($item);
        });

        $data['gender'] = '';

        if ('Niveau Master2  ou ingénieur' === $data['initial_training']) {
            $data['initial_training'] = 'Niveau Master2 ou ingénieur';
        }

        return $data;
    }
}
