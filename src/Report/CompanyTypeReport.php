<?php

declare(strict_types=1);

namespace App\Report;

/**
 * Report on company Type.
 */
class CompanyTypeReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.companyType as companyType')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->addGroupBy('response.companyType');

        $this->data = $this->queryBuilder->fetchAllAssociative();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'company_type';
    }
}
