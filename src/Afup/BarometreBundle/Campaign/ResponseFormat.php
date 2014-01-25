<?php

namespace Afup\BarometreBundle\Campaign;

class ResponseFormat
{
    /**
     * @return array
     */
    public function getColumns()
    {
        return [
            "gross_annual_salary",
            "variable_annual_salary",
            "AnnualSalary",
            "salary_satisfaction",
            "status",
            "initial_training",
            "company_type",
            "company_size",
            "company_department",
            "job_interest",
            "speciality",
            "php_version",
            "has_certification",
            "certification_list",
            "php_strength",
            "email",
            "has_formation",
            "formation_subject",
            "formation_impact",
        ];
    }
}
