<?php

declare(strict_types=1);

namespace App\Report;

/**
 * Report on company size.
 */
class CompanySizeReport extends AbstractReport
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->queryBuilder
            ->select('response.companySize as companySize')
            ->addSelect('COUNT(response.id) as nbResponse')
            ->addGroupBy('response.companySize');

        $this->data = $this->queryBuilder->fetchAllAssociative();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'company_size';
    }
}
