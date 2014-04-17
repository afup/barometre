<?php

namespace Afup\Barometre\Report;

/**
 * Report on company department
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
            ->setParameter(':minResult', $this->minResult)
            ->addGroupBy('response.companyDepartment');

        $this->data = $this->queryBuilder->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'company_department';
    }
}
