<?php

namespace Afup\BarometreBundle\Campaign\Format\Formats;

class Format2016 extends Format2014
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
            'other_language',
            'speciality',
            'php_version',
            'has_certification',
            'certification_list',
            'php_strength',
            'has_formation',
            'formation_subject',
            'formation_impact',
            'gender',
            'email',
            'remote_usage',
            'meetup_participation',
            'technological_watch',
            'os_developpment',
        ];
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function alterData(array $data)
    {
        $data = parent::alterData($data);

        return $data;
    }
}
