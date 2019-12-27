<?php

namespace Afup\BarometreBundle\Campaign\Format\Formats;

class Format2019 extends Format2014
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
            'freelance_tjm',
            'freelance_average_work_day',
            'contract_work_duration',
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
            'hosting_type',
            'container_environment_usage',
            'work_method',
            'speciality',
            'php_version',
            'php_documentation_source',
            'french_php_documentation_quality',
            'has_certification',
            'certification_list',
            'php_strength',
            'has_formation',
            'formation_subject',
            'formation_impact',
            'gender',
        ];
    }

    public function alterData(array $data)
    {
        $data = parent::alterData($data);

        if ($data['gender'] == 'Une personne non-binaire') {
            $data['gender'] = "Personnes non-binaires";
        }

        return $data;
    }
}
