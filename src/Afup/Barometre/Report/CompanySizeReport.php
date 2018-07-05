<?php

namespace Afup\Barometre\Report;

/**
 * Report on company size
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

        $this->data = $this->queryBuilder->execute()->fetchAll();
        $this->data = $this->addPercentResponse($this->data);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'company_size';
    }
}
