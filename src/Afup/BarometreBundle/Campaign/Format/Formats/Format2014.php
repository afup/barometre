<?php

namespace Afup\BarometreBundle\Campaign\Format\Formats;

use Afup\BarometreBundle\Campaign\Format\FormatInterface;
use Afup\BarometreBundle\Enums\ExperienceEnums;

class Format2014 implements FormatInterface
{
    /**
     * @return array
     */
    public function getColumns()
    {
        return array(
            '',
            "gross_annual_salary",
            "variable_annual_salary",
            "salary_satisfaction",
            "initial_training",
            'status',
            "job_title",
            "experience",
            "company_department",
            "company_type",
            "company_size",
            "job_interest",
            "speciality",
            "php_version",
            "has_certification",
            "certification_list",
            "php_strength",
            "has_formation",
            "formation_subject",
            "formation_impact",
            "email",
            "sexe",
        );
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function alterData(array $data)
    {
        if ($data['experience'] == '2 à 5 ans') {
            $data['experience'] = "3 à 5 ans";
        } elseif ($data['experience'] == '5 à 10 ans') {
            $data['experience'] = "6 à 10 ans";
        }

        $data['annual_salary'] = $data['gross_annual_salary'] + $data['variable_annual_salary'];

        if ($data['sexe'] == 'Un homme') {
            $data['sexe'] = 'Homme';
        } elseif ($data['sexe'] == 'Une femme') {
            $data['sexe'] = 'Femme';
        }

        return $data;
    }
}
