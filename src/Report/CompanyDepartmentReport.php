<?php

declare(strict_types=1);

namespace App\Report;

/**
 * Report on company department.
 */
class CompanyDepartmentReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.companyDepartment as companyDepartment')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->addSelect('AVG(response.annualSalary) as annualSalary')
            ->having('nbResponse >= :minResult')
            ->setParameter('minResult', $this->minResult)
            ->addGroupBy('response.companyDepartment');

        $this->data = $this->addPercentResponse($this->queryBuilder->fetchAllAssociative());
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'company_department';
    }

    /**
     * report weight.
     */
    public function getWeight(): int
    {
        return 40;
    }
}
