<?php

namespace Afup\BarometreBundle\Campaign\Format\Formats;

use Afup\BarometreBundle\Campaign\Format\FormatInterface;
use Afup\BarometreBundle\Enums\ExperienceEnums;
use Afup\BarometreBundle\Enums\SalarySatisfactionEnums;

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
            "gender",
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

        if ($data['gender'] == 'Un homme' || $data['gender'] == 'Homme') {
            $data['gender'] = 'Hommes';
        } elseif ($data['gender'] == 'Une femme' || $data['gender'] == 'Femme') {
            $data['gender'] = 'Femmes';
        }

        if (0 == $data['salary_satisfaction']) {
            $data['salary_satisfaction'] = SalarySatisfactionEnums::SANS_OPINION;
        }

        $status = explode(',', $data['status']);

        $data['status'] = isset($status[0]) ? ucfirst($status[0]) : '';

        if ($data['initial_training'] === 'Niveau Master2  ou ingénieur') {
            $data['initial_training'] = 'Niveau Master2 ou ingénieur';
        }

        if ($data['initial_training'] === 'Maitrise ou équivalent') {
            $data['initial_training'] = 'Autre';
        }

        return $data;
    }
}
