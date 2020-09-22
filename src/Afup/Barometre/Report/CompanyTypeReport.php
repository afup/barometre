<?php

namespace Afup\Barometre\Report;

/**
 * Report on company Type
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

        $this->data = $this->queryBuilder->execute()->fetchAll();
        $this->data = $this->addPercentResponse($this->data);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'company_type';
    }
}
