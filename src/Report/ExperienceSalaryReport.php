<?php

declare(strict_types=1);

namespace App\Report;

class ExperienceSalaryReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.experience')
            ->addSelect('AVG(response.annualSalary) as annualSalary')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->having('nbResponse >= :minResult')
            ->setParameter('minResult', $this->minResult)
            ->groupBy('response.experience');

        $this->data = $this->queryBuilder->fetchAllAssociative();
    }

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
     *
     * @return int
     */
    public function getWeight()
    {
        return 4;
    }
}
