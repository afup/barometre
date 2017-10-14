<?php

namespace Afup\BarometreBundle\Campaign\Format\Formats;

class Format2017 extends Format2014
{
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
            'company_origin',
            'other_language',
            'remote_usage',
            'meetup_participation',
            'technological_watch',
            'os_developpment',
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
        ];
    }
}
