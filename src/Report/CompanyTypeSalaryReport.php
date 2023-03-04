<?php

declare(strict_types=1);

namespace App\Report;

class CompanyTypeSalaryReport extends AbstractSalaryExperienceWithColumnReport
{
    /**
     * The report name (used for url).
     *
     * @return string
     */
    public function getName()
    {
        return 'company_type_salary';
    }

    protected function getColumn(): string
    {
        return 'companyType';
    }
}
