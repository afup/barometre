<?php

declare(strict_types=1);

namespace App\Report;

class ExperienceSalaryReport extends AbstractExperienceReport
{
    /**
     * The report name (used for url).
     *
     * @return string
     */
    public function getName()
    {
        return 'experience_salary';
    }

    /**
     * report weight.
     */
    public function getWeight(): int
    {
        return 4;
    }

    protected function getColumn(): string
    {
        return 'annualSalary';
    }
}
